<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    function dashboard(){
        return view('pegawai.pages.dashboard');
    }
}
