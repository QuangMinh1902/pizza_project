@extends('trame.modele')

@section('title', 'Détail de commande')

@section('contents')
    <h1>Détail de la commande</h1>

    @forelse ($pizzas as $pizza)
        @if ($loop->first)
            <table>
                <tr>
                    <th>Nom de pizza</th>
                    <th>PRIX</th>
                    <th>QUANTITY</th>
                </tr>
        @endif
        <tr>
            <td>{{ $pizza->nom }}</td>
            <td>{{ $pizza->prix }}</td>
            <td>{{ \App\Models\CommandePizza::where(['commande_id' => $commande_id, 'pizza_id' => $pizza->id])->first()->qte }}
            </td>
        </tr>

        @if ($loop->last)
            <tr>
                <td colspan="3" style="color: #228b22;font-weight: bold;font-size: 25px">
                    <strong>Statut : {{ $statut }} </strong>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="color: #228b22;font-weight: bold;font-size: 25px">
                    <strong>Prix total : {{ $prixTotal }} $ </strong>
                </td>
            </tr>
            </table>
        @endif
    @empty
        <p style="text-align: center; color:red;font-weight: bold;font-size: 20px">les pizzas que vous avez achetées ont été
            supprimées </p>
    @endforelse
    <a href="{{ route('liste_commandes', ['id' => Auth::id()]) }}"> Revenir</a>
@endsection
