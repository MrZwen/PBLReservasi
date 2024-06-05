<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function dashboard(){
        return view('admin.pages.dashboard');
    }

    function kamar(){
        return view('admin.pages.kamar');
    }

    function users(){
        $data = User::with('role')
        ->orderBy('id', 'asc')
        ->paginate(5)->withPath('custom-pagination-path');
        $data->withPath('/users');
        return view('admin.pages.users', ['data' => $data]);
    }
}
