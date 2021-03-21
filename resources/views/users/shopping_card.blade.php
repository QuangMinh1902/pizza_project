@extends('trame.modele')

@section('title', 'Votre Panier')

@section('contents')
    <h1> Panier</h1>
    @forelse ($pizza as $p)
        @if ($loop->first)
            <table>
                <tr>
                    <th>NOM</th>
                    <th>PRIX/PRODUIT</th>
                    <th>QUANTITÉ</th>
                    <th>PRIX_TOTAL</th>
                    <th>OPÉRATION</th>
                </tr>
        @endif
        <tr>
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
                <td colspan="5" style="color: #228b22;font-weight: bold;font-size: 25px">
                    Le Prix Total : {{ Session::get('prixTOTAL') }} $ <br>
                    <a style="margin-left:600px;background-color:#daa520" class="bouncy"
                        href="{{ route('confirm_order') }}">Acheter
                    </a>
                </td>
            </tr>
            </table>
        @endif
    @empty
        <p style="text-align: center; color:red;font-weight: bold;font-size: 20px">Panier est vide </p>
    @endforelse


    <a href="{{ route('back_list') }}">Back to Menu</a>
@endsection
