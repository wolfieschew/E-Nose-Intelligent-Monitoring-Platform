<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionEnoseModel;
use App\Models\DeviceModel;
use App\Models\User;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;




class TransactionEnoseController extends Controller
{
    public function index()
    {
        $userName = Auth::user()->user_name;

        $transactionEnoses = DB::table('transaction_enose as te')
            ->join('device_user_mapping as dum', 'te.device_id', '=', 'dum.device_id')
            ->where('dum.user_name', $userName)
            ->orderBy('te.date_time', 'desc')
            ->select('te.*')
            ->paginate(10);

        $transactionEnoses->getCollection()->transform(function ($item) {
            return [
                'user_key' => $item->user_key,
                'device_id' => $item->device_id,
                'date_time' => $item->date_time,
                'type' => $item->type,
                'data_send' => json_decode($item->data_send, true),
                'value' => json_decode($item->value, true),
            ];
        });
        if ($transactionEnoses->isEmpty()) {
            return view('pages.404');
        }

        return view('pages.transaksi-enose', ['data' => $transactionEnoses]);
    }
    public function dashboard()
    {
        $userName = Auth::user()->user_name;

        // Cek apakah user punya device tipe E-Nose
        $hasENose = DB::table('device_user_mapping as dum')
            ->join('device as d', 'dum.device_id', '=', 'd.device_id')
            ->where('dum.user_name', $userName)
            ->where('d.type', 'e-nose')
            ->exists();

        // Cek apakah user punya device tipe Edge
        $hasEdge = DB::table('device_user_mapping as dum')
            ->join('device as d', 'dum.device_id', '=', 'd.device_id')
            ->where('dum.user_name', $userName)
            ->where('d.type', 'edge')
            ->exists();

        // Jika user hanya punya Edge device, langsung redirect
        if (!$hasENose && $hasEdge) {
            return redirect()->route('edge-dashboard');
        }

        // Jika user tidak punya device sama sekali
        if (!$hasENose && !$hasEdge) {
            return view('pages.404');
        }

        // Jika user punya E-Nose, lanjut tampilkan dashboard E-Nose
        $totalDataSample = DB::table('transaction_enose as te')
            ->join('device_user_mapping as dum', 'te.device_id', '=', 'dum.device_id')
            ->where('dum.user_name', $userName)
            ->count();

        if ($totalDataSample === 0) {
            return view('pages.404');
        }

        $totalDevice = DB::table('device_user_mapping as dum')
            ->join('device as d', 'dum.device_id', '=', 'd.device_id')
            ->where('dum.user_name', $userName)
            ->where('d.type', 'e-nose')
            ->distinct('dum.device_id')
            ->count('dum.device_id');

        $totalType = DB::table('transaction_enose as te')
            ->join('device_user_mapping as dum', 'te.device_id', '=', 'dum.device_id')
            ->where('dum.user_name', $userName)
            ->distinct('type')
            ->count('type');

        $lastActive = DB::table('transaction_enose as te')
            ->join('device_user_mapping as dum', 'te.device_id', '=', 'dum.device_id')
            ->where('dum.user_name', $userName)
            ->orderByDesc('te.date_time')
            ->value('te.date_time');

        $lastActiveFormatted = $lastActive ? date('H:i:s, d M Y', strtotime($lastActive)) : 'No activity';

        $data = DB::table('transaction_enose as te')
            ->join('device_user_mapping as dum', 'te.device_id', '=', 'dum.device_id')
            ->where('dum.user_name', $userName)
            ->select(DB::raw('te.device_id, COUNT(*) as total'))
            ->groupBy('te.device_id')
            ->pluck('total', 'te.device_id');

        $labels = $data->keys();
        $values = $data->values();

        $monthData = DB::table('transaction_enose as te')
            ->join('device_user_mapping as dum', 'te.device_id', '=', 'dum.device_id')
            ->select(DB::raw("DATE_FORMAT(te.date_time, '%m-%Y') as month"), 'te.device_id', DB::raw('COUNT(*) as total'))
            ->where('dum.user_name', $userName)
            ->groupBy('month', 'te.device_id')
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

        return view('pages.index', [
            'totalDataSample' => $totalDataSample,
            'totalDevice' => $totalDevice,
            'totalType' => $totalType,
            'lastActive' => $lastActiveFormatted,
            'labels' => $labels,
            'values' => $values,
            'labels_Line' => $labels_Line,
            'datasets' => $datasets,
        ]);
    }


    public function downloadRowCSV(Request $request)
{
    $date_time = $request->query('date_time');
    $userName = Auth::user()->user_name;

    $item = DB::table('transaction_enose as te')
        ->join('device_user_mapping as dum', 'te.device_id', '=', 'dum.device_id')
        ->where('te.date_time', '=', $date_time)
        ->where('dum.user_name', $userName)
        ->select('te.date_time', 'te.data_send', 'te.value')
        ->first();

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

    return response()->stream($callback, 200, $headers);
}

}
