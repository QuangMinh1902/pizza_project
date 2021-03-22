@extends('trame.login_css')

@section('title', 'Page Login')

@section('contents')
    <div class="login">
        <div class="login-header">
            <h1>Login</h1>
            <form action="{{ route('login') }}" method="post">
                @csrf
        </div>
        <div class="login-form">
            <h3>Username:</h3>
            <input type="text" placeholder="Enter login" name="login"><br>
            <span style="color: red">@error('login')
                    {{ $message }}
                @enderror
            </span>
            <h3>Password:</h3>
            <input type="password" placeholder="Enter Password" name="mdp">
            <br>
            <input type="submit" value="Login">
            <br>
            <br>
            <a class="sign-up" href="{{ route('register') }}">Create an account</a>
            </form>
        </div>
    </div>

@endsection
