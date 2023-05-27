<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    // public function login(Request $request)
    // {
    //     $check = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);
    //     // dd($check);
    //     if (Auth::guard('web')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
    //         return redirect()->route('user.home')->with('error', 'Login berhasil');
    //     } else {
    //         return redirect()->route('login')->with('error', 'Email atau Password salah');
    //     }
    // }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // return redirect()->intended('user.home');
            return redirect()->route('user.home')->with('error', 'Login berhasil');
        }

        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


}