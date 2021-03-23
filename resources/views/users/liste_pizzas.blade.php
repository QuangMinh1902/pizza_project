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
        - Votre ID is : {{ Auth::id() }}
    </p>
    <h1>MENU</h1>

    @unless(empty($pizzas))
        <div class="container mt-5">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>NOM</th>
                    <th>DESCRIPTION</th>
                    <th>PRIX</th>
                    <th>PANIER</th>
                </tr>
                @foreach ($pizzas as $pizza)
                    <tr>
                        <td>{{ $pizza->id }}</td>
                        <td>{{ $pizza->nom }}</td>
                        <td>{{ $pizza->description }}</td>
                        <td>{{ $pizza->prix }}</td>
                        @if (Session::has($pizza->nom))
                            <td style="color: red"> <strong>AJOUTÉ</strong> </td>
                        @else
                            <td><a class="bouncy" style="background-color:#800000"
                                    href="{{ route('add_card', ['nom' => $pizza->nom, 'id' => $pizza->id, 'prix' => $pizza->prix]) }}">
                                    AJOUTER
                                </a></td>
                        @endif
                    </tr>
                @endforeach
            </table>
            <div class="d-flex justify-content-center">
                {{ $pizzas->links() }}
            </div>
        </div>

    @endunless
@endsection
