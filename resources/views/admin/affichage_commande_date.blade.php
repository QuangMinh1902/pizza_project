@extends('trame.modele')

@section('title', 'Affichage des commandes')

@section('contents')
    <ul>
        <li><a class="active" href="{{ route('pizzas.index') }}">Home</a></li>
        <li><a href={{ route('chercher.commandes') }}> Chercher les commandes</a></li>
        <li style="float:right"> <a href="{{ route('logout') }}">Déconnexion</a>
        </li>
    </ul>
    <h1>Liste des commandes</h1>
    @forelse ($commandes as $commande )
        @if ($loop->first)
            <table>
                <tr>
                    <th>ID</th>
                    <th>STATUT</th>
                    <th>DETAIL</th>
                </tr>
        @endif
        <tr>
            <td style="font-weight: bold">{{ $commande->id }}</td>
            <td>{{ $commande->statut }}</td>
            <td><a class="bouncy" style="background-color:#228B22"
                    href="{{ route('admin.detail.commandes', ['id' => $commande->id]) }}"> Regarder
                </a>
            </td>
        </tr>
        @if ($loop->last)
            </table>
        @endif
    @empty
        <p> Aucune commande</p>
    @endforelse
@endsection
