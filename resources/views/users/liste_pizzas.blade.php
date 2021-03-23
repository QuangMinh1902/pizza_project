@extends('trame.pagination')

@section('title', 'Liste des pizzas')

@section('contents')
    <ul>
        <li><a class="active" href="{{ route('pizzas.listPizzas') }}">Home</a></li>
        <li><a href="{{ route('change_password') }}"> Changer le mot de passe</a></li>
        <li><a href="{{ route('redirect_card') }}">Panier</a></li>
        <li><a href="{{ route('liste_commandes', ['id' => Auth::id()]) }}">Vos Commandes </a></li>
        <li style="float:right"> <a href="{{ route('logout') }}">Déconnexion</a>
        </li>
    </ul>
    <p style="color: yellowgreen; font-size: 20px;text-align: center">
        Salut <strong>{{ Auth::user()->prenom }}</strong>
        - Votre ID est : {{ Auth::id() }}
    </p>
    <h1>MENU</h1>
    @forelse ($pizzas as $pizza)
        @if ($loop->first)
            <div class="container mt-5">
                <div class="d-flex justify-content-center">
                    {{ $pizzas->links() }}
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-primary">
                            <th scope="col">ID</th>
                            <th scope="col">NOM</th>
                            <th scope="col">DESCRIPTION</th>
                            <th scope="col">PRIX</th>
                            <th scope="col">PANIER</th>
                        </tr>
                    </thead>
                    <tbody>
        @endif
        <tr>
            <th scope="row">{{ $pizza->id }}</th>
            <td>{{ $pizza->nom }}</td>
            <td>{{ $pizza->description }}</td>
            <td>{{ $pizza->prix }}</td>
            @if (Session::has($pizza->nom))
                <td style="color: red"> <strong>AJOUTÉ</strong> </td>
            @else
                <td>
                    <a class="bouncy" style="background-color:#800000"
                        href="{{ route('add_card', ['nom' => $pizza->nom, 'id' => $pizza->id, 'prix' => $pizza->prix]) }}">
                        AJOUTER
                    </a>
                </td>
            @endif
        </tr>
        @if ($loop->last)
            </table>
            </tbody>
            </div>
        @endif
    @empty
        <p style="text-align: center; color:red;font-weight: bold;font-size: 20px">Il n'y a aucune pizza pour commander </p>
    @endforelse
@endsection
