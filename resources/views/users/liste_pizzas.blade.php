@extends('trame.modele')

@section('title', 'Liste des pizzas')

@section('contents')
    <h1>MENU</h1>
    <h2><a href="{{ route('change_password') }}"> Changer votre mot de passe</a></h2>

    @unless(empty($pizzas))
        <h2><a href="{{ route('redirect_card') }}">Panier</a></h2>
        <h2>Vos Commandes</h2>
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
                        <td><a
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
