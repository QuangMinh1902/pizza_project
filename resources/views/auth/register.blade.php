@extends('trame.register_form')

@section('title', 'Création du compte')

@section('contents')
    <form method="post" action="{{ route('store') }}">
        @csrf
        <div id="login-box">
            <div class="left">
                <h1>Sign up</h1>
                <input type="text" name="login" placeholder="Enter Login">
                <input type="password" name="mdp" placeholder="Enter Password">
                <input type="password" name="mdp_confirmation" placeholder="Retype password">

                <input type="submit" name="signup_submit" value="Register">
            </div>

        </div>
    </form>
@endsection
