@extends('trame.modele')

@section('title', 'Affichage des commandes')

@section('contents')
<h1>Liste des commandes</h1>
    @forelse ($commandes as $commande )
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
            <td>{{ $commande->statut }}</td>
            <td>{{ $commande->created_at }}</td>
            <td><a class="bouncy" style="background-color:#228B22"
                    href="{{ route('detail_commandes', ['id' => $commande->id]) }}"> Regarder
                </a>
            </td>
        </tr>
        @if ($loop->last)
            </table>
        @endif
    @empty
    <p> il n'y a pas</p>
    @endforelse
@endsection
