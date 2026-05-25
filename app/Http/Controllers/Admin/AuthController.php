<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('is_admin')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        if (hash_equals((string) config('wedding.admin_password'), (string) $request->input('password'))) {
            $request->session()->regenerate();
            $request->session()->put('is_admin', true);

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['password' => 'That password is incorrect.']);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('is_admin');
        $request->session()->regenerate();

        return redirect()->route('admin.login');
    }
}
