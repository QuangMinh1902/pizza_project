@extends('trame.modele')

@section('title', 'Vos Commandes')

@section('contents')

    <h1> Liste de vos commandes non-récupérées</h1>

    @forelse ($commandes as $commande)
        @if ($loop->first)
            <table>
                <tr>
                    <th>ID</th>
                    <th>STATUT</th>
                    <th>CREATED_AT</th>
                    <th>DETAIL</th>
                </tr>
        @endif

        <tr>
            <td style="font-weight: bold">{{ $commande->id }}</td>
            <td> {{ $commande->statut }}</td>
            <td>{{ $commande->created_at }}</td>
            <td>
                <a class="bouncy" style="background-color:#228B22"
                    href="{{ route('user_commande', ['id' => $commande->id]) }}">Regarder
                </a>
            </td>
        </tr>

        @if ($loop->last)
            </table>
        @endif

    @empty
        <p style="text-align: center; color:red;font-weight: bold;font-size: 20px">vous n'avez aucune commande </p>
    @endforelse

@endsection
