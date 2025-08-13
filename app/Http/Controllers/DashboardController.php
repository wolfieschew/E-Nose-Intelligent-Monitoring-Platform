<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(){
        return view('pages.index');
    }
    public function edge(){
        return view('pages.edge-dashboard');
    }
}
