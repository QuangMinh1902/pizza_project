<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\User;

use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function formLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'mdp' => 'required|string',
        ]);

        $credentials = [
            'login' => $request->input('login'),
            'password' => $request->input('mdp')
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->type === 'admin') {
                return redirect()->intended('pizzas');
            } else if (Auth::user()->type === 'user') {
                return redirect()->intended('pizzas/user');
            } else {
                return redirect()->intended('commandes/pizzaiolo');
            }
        }
        return back()->with('etat', 'Login or password is not correct');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flush();
        return redirect()->route('login');
    }
}
