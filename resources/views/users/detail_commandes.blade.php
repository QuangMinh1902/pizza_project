@extends('trame.modele')

@section('title', 'Détail de commande')

@section('contents')
    <h1>Détail de la commande</h1>

    @forelse ($pizzas as $pizza)
        @if ($loop->first)
            <table style="margin: auto">
                <tr>
                    <th>Nom de pizza</th>
                    <th>PRIX</th>
                    <th>QUANTITY</th>
                </tr>
        @endif
        <tr>
            <td>{{ $pizza->nom }}</td>
            <td>{{ $pizza->prix }}</td>
            <td>{{ \App\Models\CommandePizza::where(['commande_id' => $commande_id, 'pizza_id' => $pizza->id])->first()->quantity_pizza }}
            </td>
        </tr>

        @if ($loop->last)
            <tr>
                <td colspan="3" style="text-align: center;color: #228b22">
                    <strong>Statut : {{ $statut }} </strong>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center;color: #228b22">
                    <strong>Prix total : {{ $prix }} $ </strong>
                </td>
            </tr>
            </table>
        @endif
    @empty

    @endforelse
    </table>

    <a href="{{ route('liste_commandes', ['id' => Auth::id()]) }}"> Revenir</a>
@endsection
