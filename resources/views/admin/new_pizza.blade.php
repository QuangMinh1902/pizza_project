@extends('trame.modele')

@section('title', 'Ajouter une nouvelle pizza')

@section('contents')
    <ul>
        <li><a class="active" href="{{ route('pizzas.index') }}">Home</a></li>
        <li style="margin-left: 1075px"> <a href="{{ route('logout') }}">Déconnexion</a>
        </li>
    </ul>
  <h2>Ajouter une pizza</h2>
    <form method="post" action="{{ route('pizzas.store') }}">
        @csrf
        <p>
            <label for="nom">Nom</label><br>
            <input type="text" name="nom" value="{{ old('nom') }}">
            <span class="error">@error('nom')
                    {{ $message }}
                @enderror
            </span>
        </p>
        <p>
            <label for="description">Description</label><br>
            <input type="text" name="description" value="{{ old('description') }}">
            <span class="error">@error('description')
                    {{ $message }}
                @enderror
            </span>
        </p>

        <p>
            <label for="prix">Prix</label><br>
            <input type="number" name="prix" value="{{ old('prix') }}">
            <span class="error">@error('prix')
                    {{ $message }}
                @enderror
            </span>
        </p>

        <p>
            <button type="submit">Envoyer</button>
        </p>
    </form>
@endsection
