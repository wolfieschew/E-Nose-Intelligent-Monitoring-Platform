<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeviceModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DeviceController extends Controller
{
    //
    public function device()
    {
        $userName = Auth::user()->user_name;

        $devices = DB::table('device as d')
            ->join('device_user_mapping as dum', 'd.device_id', '=', 'dum.device_id')
            ->where('dum.user_name', $userName)
            ->select('d.*') // ambil kolom dari device
            ->get();
        if ($devices->isEmpty()) {
            return view('pages.404');
        }
        return view('pages.device', ['data' => $devices]);
    }
}
