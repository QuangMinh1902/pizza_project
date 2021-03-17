@extends('trame.modele')

@section('title', 'Votre Panier')

@section('contents')

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
            <td>{{ $p->prix }}</td>
            <td>
                <form action="{{ route('cart.update', ['nom' => $p->nom, 'prix' => $p->prix]) }}">
                    <input name="quantity" type="number" value="{{ Session::get($p->nom)['pizza_qty'] }}">
                    <input type="submit" value="save">
                </form>
            </td>
            <td>{{ Session::get($p->nom)['prix_total'] }}</td>
            <td><a href="{{ route('delete_from_card', ['nom' => $p->nom, 'id' => $p->id]) }}">Supprimer</a></td>
        </tr>
        @if ($loop->last)
            </table>
        @endif

        <h3>
            Le Prix Total : {{ Session::get('prixTOTAL') }} $
        </h3>

    @empty
        <p style="text-align: center; color:red;font-weight: bold;font-size: 20px">vous n'avez rien dans le panier </p>
    @endforelse


    @if (Session::has('ListId'))
        <h3>
            <a href="{{ route('confirm_order') }}">Acheter </a>
        </h3>
    @endif

    <a href="{{ route('back_list') }}">Back to Menu</a>

@endsection
