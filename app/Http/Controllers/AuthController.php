<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function index() {
        return view('login');
    }
    function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ],[
            'username' => 'Username Wajib Di isi',
            'password' => 'Password Wajib Di isi'
        ]);

        $infologin = $request->only('username', 'password');

        if (Auth::attempt($infologin)) {
            return redirect('dashboard');
        }else {
            return redirect('')->withErrors('Username dan Password salah !!!')->withInput();
        }
    }
    function logout(){
        Auth::logout();
        return redirect('');
    }
}
