@extends('trame.modele')

@section('title', 'Contrôle de la date ')

@section('contents')

    <h2>Contrôle de la date </h2>

    <form action="{{ route('affichage.commandes') }}" method="post">
        @csrf
        <label for="date">Date:</label>
        <input type="date" name="date" value="{{ old('date') }}">
        <input type="submit" value="envoyer">
    </form>

@endsection
