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
            'nom' => 'required|alpha|min:4|max:20',
            'prenom' => 'required|alpha|min:4|max:20',
            'login' => 'required|alpha|min:4|max:16|unique:users',
            'mdp' => 'required|alpha|min:4|max:16|confirmed'
        ]);

        $user = new User();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->login = $request->login;
        $user->mdp = Hash::make($request->mdp);
        $user->save();

        $request->session()->flash('etat', 'Votre compte a été créé avec succès');

        Auth::login($user);

        return redirect()->route('login');
    }
}
