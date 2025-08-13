<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminTransaksiController extends Controller
{
    //
    public function adminTransactionEnose(){
        return view('pages.admin-transaksi-enose');
    }
    public function adminTransactionEdge(){
        return view('pages.admin-transaksi-edge');
    }
}
