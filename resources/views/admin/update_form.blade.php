@extends('trame.modele')

@section('title', 'Modifier Information')

@section('contents')

    <form method="post" action="{{ route('pizzas.update', ['id' => $pizza->id]) }}">
        @method('put')
        <p>
            <label for="nom">Nom</label> <br>
            <input type="text" name="nom" value="{{ $pizza->nom }}">
        </p>

        <p>
            <label for="descript">Description</label> <br>
            <input type="text" name="description" value="{{ $pizza->description }}">
        </p>
        <p>
            <button type="submit">Modifier</button>
        </p>
        @csrf
    </form>

@endsection
