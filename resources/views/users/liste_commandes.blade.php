@extends('trame.modele')

@section('title', 'Vos Commandes')

@section('contents')
    <ul>
        <li><a class="active" href="{{ route('pizzas.listPizzas') }}">Home</a></li>
        <li><a href="{{ route('change_password') }}"> Changer le mot de passe</a></li>
        <li><a href="{{ route('redirect_card') }}">Panier</a></li>
        <li><a href="{{ route('liste_commandes', ['id' => Auth::id()]) }}">Vos Commandes </a></li>
        <li><a href="{{ route('commandes_nonRecuperees') }}">Vos commandes en attente </a></li>
        <li style="float:right"> <a href="{{ route('logout') }}">Déconnexion</a>
        </li>
    </ul>
    <h1> Liste de vos commandes</h1>

    @forelse ($commandes as $commande)
        @if ($loop->first)
            <table>
                <tr>
                    <th>ID</th>
                    <th>CREATED_AT</th>
                    <th>DETAIL</th>
                </tr>
        @endif
        <tr>
            <td style="font-weight: bold">{{ $commande->id }}</td>
            <td>{{ $commande->created_at }}</td>
            <td style="text-align: center">
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
