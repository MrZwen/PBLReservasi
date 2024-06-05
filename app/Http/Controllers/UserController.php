<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function profileAdmin(Request $request){
        // $request->session()->flush();
        return view('admin.pages.profile');
    }

    function profileCostumer(Request $request){
        // $request->session()->flush();
        return view('pages.landing');
    }
}
