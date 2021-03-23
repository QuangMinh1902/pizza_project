@extends('trame.modele')

@section('title', 'Modifier Information')

@section('contents')
    <ul>
        <li><a class="active" href="{{ route('pizzas.index') }}">Home</a></li>
        <li style="float:right"> <a href="{{ route('logout') }}">Déconnexion</a>
        </li>
    </ul>
    <h2>Modifier la pizza</h2>
    <form method="post" action="{{ route('pizzas.update', ['id' => $pizza->id]) }}">
        @method('put')
        <p>
            <label for="nom">Nom</label> <br>
            <input type="text" name="nom" value="{{ old('nom') }}">
            <span class="error">@error('nom')
                    {{ $message }}
                @enderror
            </span>
        </p>

        <p>
            <label for="descript">Description</label> <br>
            <input type="text" name="description" value="{{ old('description') }}">
            <span class="error">@error('description')
                    {{ $message }}
                @enderror
            </span>
        </p>

        <p>
            <label for="prix">Prix</label> <br>
            <input type="text" name="prix" value="{{ old('prix') }}">
            <span class="error">@error('prix')
                    {{ $message }}
                @enderror
            </span>
        </p>

        <p>
            <button type="submit">Envoyer</button>
        </p>
        @csrf
    </form>

@endsection
