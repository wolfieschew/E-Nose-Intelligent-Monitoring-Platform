<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMappingModel;

class UserMappingController extends Controller
{
    //
    public function userManagement(){                                                                                               
        $userMapping = UserMappingModel::all();
        // dd($userMapping);
        return view('pages.admin-user-management',[
            'data' => $userMapping,
        ]);
    }
    public function addUser (){
        return view('components.form-user');
    }
}
