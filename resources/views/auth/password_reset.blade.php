@extends('trame.password_reset_form')

@section('title', 'Changement du mot de passe')
    <ul>
        <li><a class="active" href="{{ route('pizzas.listPizzas') }}">Home</a></li>
        <li><a href="{{ route('redirect_card') }}">Panier</a></li>
        <li><a href="{{ route('liste_commandes', ['id' => Auth::id()]) }}">Vos Commandes </a></li>
        <li style="float:right"> <a href="{{ route('logout') }}">Déconnexion</a>
        </li>
    </ul>
    <form id="signup" method="post" action="{{ route('update_password') }}">
        @csrf
        <h1>Change your password</h1>
        <label for="old_password">Old Password</label>
        <input type="password" placeholder="Enter your old password" name="old_password"
            value="{{ old('old_password') }}">
        <span class="error">@error('old_password')
                {{ $message }}
            @enderror
        </span>
        <br>
        <label for="password">New Password</label>
        <input type="password" placeholder="Choose your password" name="new_password" value="{{ old('new_password') }}">
        <span class="error">@error('new_password')
                {{ $message }}
            @enderror
        </span>
        <br>
        <label for="confirm_password">Confirm password</label>
        <input type="password" placeholder="Confirm password" name="confirm_password">
        <span class="error">@error('confirm_password')
                {{ $message }}
            @enderror
        </span>
        <button type="submit">Update password</button>
    </form>
