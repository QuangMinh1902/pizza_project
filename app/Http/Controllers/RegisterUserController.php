<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'login' => 'required|string|max:16|unique:users',
            'mdp' => 'required|string|min:6|max:20|confirmed'
        ]);

        $user = new User();
        $user->login = $request->login;
        $user->mdp = Hash::make($request->mdp);
        $user->save();

        $request->session()->flash('etat', 'User added');

        Auth::login($user);

        return redirect()->route('login');
    }
}
