<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\VarDumper\Caster\RedisCaster;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function login(){
        return view('Auth.pages.login');
    }

    function register(){
        return view('Auth.pages.register');
    }

    function registerauth(Request $request){
        $validate = Validator::make($request->all(), [
            'username' => 'required|min:5|max:255|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required|numeric|unique:users',
            'address' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validate->errors()
            ]);
        } else {
            $user = new User();
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->save();
            return response()->json([
                'status' => 200,
                'messages' => 'Register Successfully'
            ]);
        }
    }

    function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function authentication(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // $remember = $request->has('remember');
        // if(Auth::attempt($crendentials, $remember)){

        // }
    
        $user = User::where('username', $credentials['username'])->first();
    
        if (!$user) {
            session()->flash('status', 'failed');
            session()->flash('message', 'Username yang anda input tidak ditemukan!');
            return redirect()->back()->withInput();
        }
    
        if (!Hash::check($credentials['password'], $user->password)) {
            session()->flash('status', 'failed');
            session()->flash('message', 'Password yang anda input salah!');
            return redirect()->back()->withInput();
        }
    
        if ($user->status !== 'active') {
            session()->flash('status', 'failed');
            session()->flash('message', 'Akun anda belum di verifikasi, silahkan cek email terlebih dahulu untuk melakukan verifikasi!');
            return redirect()->back()->withInput();
        }
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if($user->role_id == 1){
                return redirect('admin');
            } elseif ($user->role_id == 2){
                return redirect('pegawai');
            } else {
                return redirect('profile');
            }
        }
    
        session()->flash('status', 'failed');
        session()->flash('message', 'Username atau Password yang anda input tidak sesuai!');
        return redirect()->back()->withInput();
    }

    
}