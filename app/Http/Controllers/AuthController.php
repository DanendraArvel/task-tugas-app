<?php

namespace App\Http\Controllers;

date_default_timezone_set("Asia/Jakarta");

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function Login(Request $request)
    {
        Auth::attempt($request->only('email', 'password'));

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session([
                'user_id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
            ]);

            return redirect('/dashboard')->with('success', 'Login successful!');
        }
        return back()->with('error', 'Email or Password is incorrect.');
    }

    public function Logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login')->with('success', 'Logged out successfully.');
    }
}