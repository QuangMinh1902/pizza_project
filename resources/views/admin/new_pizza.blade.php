@extends('trame.modele')

@section('title', 'Ajouter une nouvelle pizza')

@section('contents')
    <form method="post" action="{{ route('pizzas.store') }}">
        @csrf
        <p>
            <label for="nom">Nom</label><br>
            <input type="text" name="nom" value="{{ old('nom') }}">
        </p>
        <p>
            <label for="description">Description</label><br>
            <input type="text" name="description" value="{{ old('description') }}">
        </p>

        <p>
            <label for="prix">Prix</label><br>
            <input type="number" name="prix" value="{{ old('prix') }}">
        </p>

        <p>
            <button type="submit">Envoyer</button>
        </p>
    </form>
@endsection
