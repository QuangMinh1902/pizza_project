@extends('trame.modele')

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
    <p style="color: yellowgreen; font-size: 30px">
        Salut <strong>{{ Auth::user()->login }}</strong>
        - Votre ID is : {{ Auth::id() }}
    </p>
    <h1>MENU</h1>
    @unless(empty($pizzas))
        <table>
            <tr>
                <th>NOM</th>
                <th>DESCRIPTION</th>
                <th>PRIX</th>
                <th>PANIER</th>
            </tr>
            @foreach ($pizzas as $pizza)
                <tr>
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
        <hr>
    @endunless
    <div>
        {{ $pizzas->links() }}
    </div>
@endsection
