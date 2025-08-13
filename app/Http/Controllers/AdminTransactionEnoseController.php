<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionEnoseModel;
use App\Models\DeviceModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminTransactionEnoseController extends Controller
{


    public function adminDashboard()
    {
        $adminUsername = Auth::user()->user_name;

        // Gunakan query builder, bukan all()
        $query = TransactionEnoseModel::query();

        $totalDataSample = $query->count();

        $totalType = (clone $query)->distinct('type')->count('type');

        $lastActive = (clone $query)->orderBy('date_time', 'desc')->value('date_time');
        $lastActiveFormatted = $lastActive ? date('H:i:s, d M Y', strtotime($lastActive)) : 'No activity';

        $data = (clone $query)
            ->selectRaw('device_id, COUNT(*) as total')
            ->groupBy('device_id')
            ->pluck('total', 'device_id');


        $labels = $data->keys();
        $values = $data->values();

        $monthData = (clone $query)
            ->select(DB::raw("DATE_FORMAT(date_time, '%m-%Y') as month"), 'device_id', DB::raw('COUNT(*) as total'))
            ->groupBy('month', 'device_id')
            ->orderBy('month')
            ->get();

        $labels_Line = $monthData->pluck('month')->unique()->values();

        $grouped = $monthData->groupBy('device_id');
        $datasets = [];
        $colors = ['#0694a2', '#1c64f2', '#7e3af2', '#facc15', '#ef4444', '#10b981', '#3b82f6'];
        $index = 0;

        foreach ($grouped as $deviceId => $records) {
            $dataPerBulan = [];

            foreach ($labels_Line as $month) {
                $entry = $records->firstWhere('month', $month);
                $dataPerBulan[] = $entry ? $entry->total : 0;
            }

            $datasets[] = [
                'label' => "$deviceId",
                'data' => $dataPerBulan,
                'borderColor' => $colors[$index % count($colors)],
                'backgroundColor' => $colors[$index % count($colors)],
                'fill' => false,
            ];

            $index++;
        }

        return view('pages.admin-index', [
            'totalDataSample' => $totalDataSample,
            'totalDevice' => DeviceModel::whereIn('device_id', $query->pluck('device_id')->unique())->count(),
            'totalUser' => User::where('user_group', 'user')->count(),
            'totalType' => $totalType,
            'lastActive' => $lastActiveFormatted,
            'labels' => $labels,
            'values' => $values,
            'labels_Line' => $labels_Line,
            'datasets' => $datasets,
            'monthData' => $monthData
        ]);
    }

    public function index()
    {
        $adminUsername = Auth::user()->user_name;

        $transactionEnoses = TransactionEnoseModel::with('device')

            ->orderBy('date_time', 'desc')
            ->paginate(10);

        $transactionEnoses->getCollection()->transform(function ($item) {
            return [
                'user_key'   => $item->user_key,
                'device_id'  => $item->device_id,
                'date_time' => $item->date_time,
                'type'       => $item->type,
                'data_send'  => json_decode($item->data_send, true),
                'value'      => json_decode($item->value, true),
                'device'     => $item->device,
            ];
        });

        return view('pages.admin-transaksi-enose', ['data' => $transactionEnoses]);
    }

    public function adminDownloadRowCSV(Request $request)
{
    $date_time = $request->query('date_time');
    $user = Auth::user();

    $query = DB::table('transaction_enose as te')
        ->join('device_user_mapping as dum', 'te.device_id', '=', 'dum.device_id')
        ->where('te.date_time', '=', $date_time)
        ->select('te.date_time', 'te.data_send', 'te.value');

    // Jika bukan admin, filter berdasarkan user_name
    if ($user->user_group !== 'admin') {
        $query->where('dum.user_name', $user->user_name);
    }

    $item = $query->first();

    if (!$item) {
        return back()->with('error', 'Data tidak ditemukan.');
    }

    // Proses sensor
    $sensorArray = json_decode($item->data_send, true);
    $flattenedSensor = [];
    if (is_array($sensorArray)) {
        foreach ($sensorArray as $reading) {
            foreach ($reading as $sensor => $value) {
                $flattenedSensor[$sensor] = $value;
            }
        }
    }

    $sensorValues = [
        $flattenedSensor['MQ3'] ?? '',
        $flattenedSensor['TGS822'] ?? '',
        $flattenedSensor['TGS2602'] ?? '',
        $flattenedSensor['MQ5'] ?? '',
        $flattenedSensor['MQ138'] ?? '',
        $flattenedSensor['TGS2620'] ?? '',
    ];

    // Ambil value
    $value = json_decode($item->value, true);
    $parsedValue = $value[0] ?? [];

    $class = $parsedValue['Class'] ?? '';
    $score = is_array($parsedValue['Score']) ? implode(',', $parsedValue['Score']) : ($parsedValue['Score'] ?? '');
    $multiclass = is_array($parsedValue['Multiclass']) ? implode(',', $parsedValue['Multiclass']) : ($parsedValue['Multiclass'] ?? '');

    // Buat CSV langsung (tanpa simpan file)
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="data_predict_' . str_replace([':', ' '], '_', $date_time) . '.csv"',
    ];

    $callback = function () use ($item, $sensorValues, $class, $score, $multiclass) {
        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['date_time', 'MQ3', 'TGS822', 'TGS2602', 'MQ5', 'MQ138', 'TGS2620', 'class', 'score', 'multiclass']);
        fputcsv($handle, [
            $item->date_time,
            ...$sensorValues,
            $class,
            $score,
            $multiclass
        ]);
        fclose($handle);
    };

   return response()->streamDownload($callback, "data_predict_$date_time.csv", $headers);
}

};
