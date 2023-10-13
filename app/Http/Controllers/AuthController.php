<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    function index()
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     */
    function login(Request $request)
    {
        Session::flash('email', $request->email);
        Session::flash('password', $request->password);

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user(); // Mengambil informasi pengguna yang saat ini masuk

            if ($user->role_id == 1) {
                return redirect()->intended('dashboard.admin');
            } elseif ($user->role_id == 2) {
                return redirect()->intended('dashboard.pelanggan');
            }
        }

        Session::flash('failed', 'Username dan Password tidak valid!');

        return redirect(route('login'));
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
