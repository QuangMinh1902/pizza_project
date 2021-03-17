
@extends('trame.modele')

@section('title', 'Détail de la commande')

@section('contents')
    <h1>Détail de la commande</h1>
    @unless(empty($pizzas))
        <h2>
            Nom du client  :{{$user}}
        </h2>
        <table>
            <tr>
                <th>NOM</th>
                <th>PRIX</th>
            </tr>
            @foreach ($pizzas as $pizza)
                <tr>
                    <td>{{ $pizza->nom }}</td>
                    <td>{{ $pizza->prix }}</td>
                </tr>
            @endforeach
        </table>
        <h2>
            Prix total : {{$prix}}
        </h2>
    @endunless
    <a href="{{route('list_commandes')}}"> Revenir</a>
@endsection
