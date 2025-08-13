<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    //
    public function transaksiEnose(){
        return view('pages.transaksi-enose');
    }
    public function transaksiEdge(){
        return view('pages.transaksi-edge');
    }
}
