@extends('trame.modele')

@section('title', 'Détail de la commande')

@section('contents')
    <ul>
        <li><a class="active" href="{{ route('list_commandes') }}">Home</a></li>
        <li style="float:right"> <a href="{{ route('logout') }}">Déconnexion</a>
        </li>
    </ul>
    <h1>Détail de la commande</h1>
    @forelse ( $pizzas as $pizza )
        @if ($loop->first)
            <h2 style="text-align: center">
                Nom du client : {{ $user }}
            </h2>
            <table>
                <tr>
                    <th>NOM</th>
                    <th>PRIX</th>
                    <th>QUANTITY</th>
                </tr>
        @endif
        <tr>
            <td>{{ $pizza->nom }}</td>
            <td>{{ $pizza->prix }} <strong>$</strong> </td>
            <td>
                {{ \App\Models\CommandePizza::where(['pizza_id' => $pizza->id, 'commande_id' => $commande_id])->first()->qte }}
            </td>
        </tr>
        @if ($loop->last)
            <tr>
                <td colspan="3" style="color: #228b22;font-weight: bold;font-size: 25px">
                    Le Prix Total : {{ $prix }} $
            </tr>
            </table>
        @endif
    @empty
        <p style="text-align: center; color:red;font-weight: bold;font-size: 20px">les pizzas ont été supprimées
        </p>
    @endforelse
@endsection
