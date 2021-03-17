@extends('trame.password_reset_form')

@section('title', 'Changement du mot de passe')

<form id="signup" method="post" action="{{route('update_password')}}">
    @csrf
    <h1>Change your password</h1>
    <label for="old_password">Old Password</label>
    <input type="password" placeholder="Enter your old password" name="old_password">
    <label for="password">New Password</label>
    <input type="password" placeholder="Choose your password" name="new_password">
    <label for="confirm_password">Confirm password</label>
    <input type="password" placeholder="Confirm password" name="confirm_password">
    <button type="submit">Update password</button>
</form>
