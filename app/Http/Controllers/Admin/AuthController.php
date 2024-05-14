<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function showLogin()
    {
        return Inertia::render('Admin/Auth/Login');
    }

    public function postLogin(Request $request)
    {
        // Validate the request
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (auth('admin')->attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function logout(Request $request)
    {
        auth('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
