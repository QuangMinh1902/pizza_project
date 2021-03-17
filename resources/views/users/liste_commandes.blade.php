@extends('trame.modele')

@section('title', 'Vos Commandes')

@section('contents')

    <h1>Détail des commandes</h1>

    @forelse ($commandes as $commande)
        @if ($loop->first)
            <table>
                <tr>
                    <th>ID</th>
                    <th>STATUT</th>
                    <th>CREATED_AT</th>
                    <th>Liste des pizzas</th>
                </tr>
        @endif

        <tr>
            <td>{{ $commande->id }}</td>
            <td>{{ $commande->statut }}</td>
            <td>{{ $commande->created_at }}</td>
            <td style="text-align: center">
                <a href="{{ route('user_commande', ['id' => $commande->id]) }}">Regarder </a>
            </td>
        </tr>

        @if ($loop->last)
            </table>
        @endif

    @empty
        <p style="text-align: center; color:red;font-weight: bold;font-size: 20px">vous n'avez aucun commande </p>
    @endforelse
    <a href="{{ route('back_list') }}">Back to Menu</a>

@endsection
