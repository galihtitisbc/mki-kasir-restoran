<?php

namespace App\Http\Controllers;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login()
    {
        return view('auth.login');
    }
    public function loginAction(LoginRequest $request)
    {
        $validated = $request->validated();
        $user = User::where('email', $request->email)->first();

        if ($user && !$user->is_active) {
            return back()->withErrors([
                'login' => 'Akun Anda Tidak Aktif, Silahkan Hubungi Pemilik Restoran',
            ]);
        }
        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            if (Auth::user()->hasAnyRole(['SUPERADMIN'])) {
                return redirect('/dashboard/superadmin/home');
            } else {
                return redirect('/dashboard/home');
            }
        }
        return back()->withErrors([
            'login' => 'Email atau password salah.',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/auth/login');
    }
}
