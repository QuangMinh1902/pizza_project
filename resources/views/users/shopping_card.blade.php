@extends('trame.modele')

@section('title', 'Votre Panier')

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
    <h1> Panier</h1>
    @forelse ($pizza as $p)
        @if ($loop->first)
            <table>
                <tr>
                    <th>ID</th>
                    <th>NOM</th>
                    <th>PRIX/PRODUIT</th>
                    <th>QUANTITÉ</th>
                    <th>PRIX_TOTAL</th>
                    <th>OPÉRATION</th>
                </tr>
        @endif
        <tr>
            <td style="font-weight: bold">{{ $p->id }}</td>
            <td>{{ $p->nom }}</td>
            <td>{{ $p->prix }} <strong>$</strong></td>
            <td>
                <form action="{{ route('cart.update', ['nom' => $p->nom, 'prix' => $p->prix]) }}">
                    <input name="quantity" type="number" value="{{ Session::get($p->nom)['pizza_qty'] }}">
                    <input type="submit" value="save">
                </form>
            </td>
            <td>{{ Session::get($p->nom)['prix_total'] }}</td>
            <td><a class="bouncy" style="background-color:#ff1493"
                    href="{{ route('delete_from_card', ['nom' => $p->nom, 'id' => $p->id]) }}">Supprimer
                </a>
            </td>
        </tr>
        @if ($loop->last)
            <tr>
                <td colspan="6" style="color: #228b22;font-weight: bold;font-size: 25px">
                    Le Prix Total : {{ Session::get('prixTOTAL') }} $ <br>
                    <a style="margin-left:690px;background-color:#daa520" class="bouncy"
                        href="{{ route('confirm_order') }}">Acheter
                    </a>
                </td>
            </tr>
            </table>
        @endif
    @empty
        <p style="text-align: center; color:red;font-weight: bold;font-size: 20px">Le panier est vide </p>
    @endforelse
@endsection
