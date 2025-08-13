<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionEdgeModel;
use App\Models\DeviceModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class TransactionEdgeController extends Controller
{
    public function dashboard(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $categoryFilter = $request->get('category');
        $deviceFilter = $request->get('device_id');

        $user = Auth::user();
        $isAdmin = $user->user_group === 'admin';
      	

        $baseQuery = TransactionEdgeModel::with(['device.userMapping'])
            ->orderBy('detection_time', 'desc');

        if (!$isAdmin) {
            $baseQuery->whereHas('device.userMapping', function ($q) use ($user) {
                $q->where('user_name', $user->user_name);
            });
        }

        // Ambil daftar device berdasarkan role
        $deviceList = DeviceModel::where('type', 'edge')
            ->when(!$isAdmin, function ($q) use ($user) {
                $q->whereHas('userMapping', function ($q2) use ($user) {
                    $q2->where('user_name', $user->user_name);
                });
            })
            ->get();

            // 🔴 Jika tidak ada device, tampilkan 404
        if ($deviceList->isEmpty()) {
            return view('pages.404');
        }


        if ($startDate && $endDate) {
            $start = Carbon::parse($startDate)->startOfDay();
            $end = Carbon::parse($endDate)->endOfDay();

            if ($end->diffInDays($start) > 30) return back()->with('error', 'Maksimal rentang tanggal adalah 30 hari');
            if ($start->gt($end)) return back()->with('error', 'Tanggal mulai tidak boleh lebih besar dari tanggal selesai');

            $baseQuery->whereBetween('detection_time', [$start, $end]);
        } else {
            $baseQuery->whereBetween('detection_time', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()]);
        }

        if ($categoryFilter) {
            switch ($categoryFilter) {
                case 'dosen-staff':
                    $baseQuery->whereIn('type', ['dosen', 'staff', 'dosen-staff']);
                    break;
                case 'mahasiswa':
                    $baseQuery->where('type', 'mahasiswa');
                    break;
                case 'lainnya':
                    $baseQuery->whereNotIn('type', ['dosen', 'staff', 'dosen-staff', 'mahasiswa']);
                    break;
            }
        }

        if ($deviceFilter) {
            $baseQuery->where('device_id', $deviceFilter);
        }

        $filteredQuery = clone $baseQuery;

        $totalDataSample = $filteredQuery->sum('value');
        $totalDevice = DeviceModel::where('type', 'edge')->count();
        $totalType = (clone $filteredQuery)->select('type')->distinct()->count();
        $lastActiveRecord = (clone $filteredQuery)->orderBy('detection_time', 'desc')->first();
        $lastActive = $lastActiveRecord ? Carbon::parse($lastActiveRecord->detection_time)->diffForHumans() : 'Tidak ada aktivitas';

        $pieQuery = clone $baseQuery;
        if (!$startDate || !$endDate) {
            $pieQuery->whereBetween('detection_time', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()]);
        }

        $pieData = $this->getPieChartData($pieQuery);
        $lineChartData = $this->getLineChartData($startDate, $endDate, $categoryFilter, $deviceFilter);

        $deviceActivity = (clone $filteredQuery)
            ->select('device_id', DB::raw('SUM(value) as total'))
            ->with('device')
            ->groupBy('device_id')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        $recentActivity = (clone $filteredQuery)
            ->with('device')
            ->orderBy('detection_time', 'desc')
            ->limit(10)
            ->get();

        $deviceList = DeviceModel::where('type', 'edge')
            ->when(!$isAdmin, function ($q) use ($user) {
                $q->whereHas('userMapping', function ($q2) use ($user) {
                    $q2->where('user_name', $user->user_name);
                });
            })
            ->get();

        return view('pages.edge-dashboard', [
            'totalDataSample' => $totalDataSample,
            'totalDevice' => $totalDevice,
            'totalType' => $totalType,
            'lastActive' => $lastActive,
            'pieLabels' => json_encode($pieData['labels']),
            'pieData' => json_encode($pieData['data']),
            'lineLabels' => json_encode($lineChartData['labels']),
            'lineData' => json_encode($lineChartData['data']),
            'deviceActivity' => $deviceActivity,
            'recentActivity' => $recentActivity,
            'types' => $this->getFilteredTypes($categoryFilter),
            'hasFilters' => $startDate || $endDate || $categoryFilter || $deviceFilter,
            'filterSummary' => $this->getFilterSummary($startDate, $endDate, $categoryFilter, $deviceFilter),
            'deviceList' => $deviceList,
            'selectedDeviceId' => $deviceFilter
        ]);
    }

    private function getPieChartData($query)
    {
        $rawData = $query->select('type', DB::raw('SUM(value) as total'))
            ->groupBy('type')
            ->get();

        $labels = [];
        $data = [];

        foreach ($rawData as $item) {
            $labels[] = $item->type;
            $data[] = $item->total;
        }

        return ['labels' => $labels, 'data' => $data];
    }

    private function getLineChartData($startDate, $endDate, $categoryFilter, $deviceFilter = null)
    {
        $lineLabels = [];
        $lineData = [];
        $types = $this->getFilteredTypes($categoryFilter);

        foreach ($types as $type) {
            $lineData[$type] = [];
        }

        $start = $startDate ? Carbon::parse($startDate)->startOfDay() : Carbon::now()->subDays(6)->startOfDay();
        $end = $endDate ? Carbon::parse($endDate)->endOfDay() : Carbon::now()->endOfDay();
        $sameDay = $start->isSameDay($end);

        if ($sameDay) {
            for ($i = 0; $i < 24; $i++) {
                $hour = $start->copy()->addHours($i);
                $lineLabels[] = $hour->format('H:00');

                foreach ($types as $type) {
                    $sumQuery = TransactionEdgeModel::whereBetween('detection_time', [$hour->copy()->startOfHour(), $hour->copy()->endOfHour()])
                        ->where('type', $type);

                    if ($deviceFilter) {
                        $sumQuery->where('device_id', $deviceFilter);
                    }

                    $lineData[$type][] = $sumQuery->sum('value');
                }
            }
        } else {
            $period = \Carbon\CarbonPeriod::create($start, $end);
            foreach ($period as $date) {
                $lineLabels[] = $date->format('M d');
                foreach ($types as $type) {
                    $sumQuery = TransactionEdgeModel::whereDate('detection_time', $date)
                        ->where('type', $type);

                    if ($deviceFilter) {
                        $sumQuery->where('device_id', $deviceFilter);
                    }

                    $lineData[$type][] = $sumQuery->sum('value');
                }
            }
        }

        return ['labels' => $lineLabels, 'data' => $lineData];
    }

    private function getFilteredTypes($categoryFilter)
    {
        if (!$categoryFilter) {
            return TransactionEdgeModel::distinct('type')->pluck('type');
        }

        switch ($categoryFilter) {
            case 'dosen-staff':
                return TransactionEdgeModel::whereIn('type', ['dosen', 'staff', 'dosen-staff'])->distinct('type')->pluck('type');
            case 'mahasiswa':
                return collect(['mahasiswa']);
            case 'lainnya':
                return TransactionEdgeModel::whereNotIn('type', ['dosen', 'staff', 'dosen-staff', 'mahasiswa'])->distinct('type')->pluck('type');
            default:
                return TransactionEdgeModel::distinct('type')->pluck('type');
        }
    }

    private function getFilterSummary($startDate, $endDate, $categoryFilter, $deviceFilter)
    {
        $summary = [];

        if ($startDate && $endDate) {
            $summary[] = "Periode: " . Carbon::parse($startDate)->format('d M Y') . " - " . Carbon::parse($endDate)->format('d M Y');
        }

        if ($categoryFilter) {
            $categories = [
                'dosen-staff' => 'Dosen-Staff',
                'mahasiswa' => 'Mahasiswa',
                'lainnya' => 'Objek Lainnya'
            ];
            $summary[] = "Kategori: " . ($categories[$categoryFilter] ?? $categoryFilter);
        }

        if ($deviceFilter) {
            $summary[] = "Device: {$deviceFilter}";
        }

        return implode(' | ', $summary);
    }



    public function index(Request $request)
    {
        $userName = Auth::user()->user_name;

        // Ambil parameter pagination (default: 20 per halaman)
        $perPage = $request->get('per_page', 20); // bisa ubah dari dropdown frontend

        // Query dasar dengan relasi 'device'
        $query = TransactionEdgeModel::with('device')
            ->whereHas('device', function ($q) use ($userName) {
                $q->whereHas('userMapping', function ($q2) use ($userName) {
                    $q2->where('user_name', $userName);
                });
            })
            ->orderBy('detection_time', 'desc');



        // Jika ingin menambahkan pencarian (optional)
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('device_id', 'like', '%' . $search . '%')
                    ->orWhere('type', 'like', '%' . $search . '%');
            });
        }

        // Eksekusi dengan pagination
        $transactionEdge = $query->paginate($perPage)->withQueryString(); // withQueryString agar pagination tetap menyimpan query filter

        if ($transactionEdge->isEmpty()) {
            return view('pages.404');
        }
        // Kirim ke view
        return view('pages.transaksi-edge', [
            'data' => $transactionEdge
        ]);
    }
}
