@extends('trame.modele')

@section('title', 'Contrôle de la date ')

@section('contents')
    <ul>
        <li><a class="active" href="{{ route('pizzas.index') }}">Home</a></li>
        <li><a href={{ route('chercher.commandes') }}> Chercher les commandes</a></li>
        <li style="float:right"> <a href="{{ route('logout') }}">Déconnexion</a>
        </li>
    </ul>
    <h2>Contrôle de la date </h2>

    <form action="{{ route('affichage.commandes') }}" method="post">
        @csrf
        <label for="date">Date:</label>
        <input type="date" name="date" value="{{ old('date') }}">
        <input type="submit" value="envoyer">
    </form>

@endsection
