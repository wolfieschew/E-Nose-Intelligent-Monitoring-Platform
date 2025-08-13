<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    public function adminIndex(){
        return view('pages.admin-index');
    }
    public function edgeDashboard(){
        return view('pages.admin-edge-dashboard');
    }
}
