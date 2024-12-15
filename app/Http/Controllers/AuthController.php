<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($request->action === 'login') {
            if (Auth::attempt($request->only('email', 'password'))) {
                $user = Auth::user();

    
                if ($user->role === 'STAFF') {
                    return redirect()->route('staff.dashboard')->with('success', 'Login berhasil sebagai STAFF.');
                } elseif ($user->role === 'GUEST') {
                    return redirect()->route('pages.report')->with('success', 'Login berhasil sebagai GUEST.');
                }

                return abort(403, 'Akses tidak diizinkan.');
            }

            return back()->withErrors(['email' => 'Email atau password salah.']);
        }

        
        if ($request->action === 'register') {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                return back()->withErrors(['email' => 'Email sudah terdaftar.']);
            }

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'GUEST', 
            ]);

            Auth::login($user);
            return redirect()->route('report.index')->with('success', 'Akun terbuat. Anda telah login.');
        }

        return back()->withErrors(['action' => 'Aksi tidak valid.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
