@extends('trame.modele')

@section('title', 'Détail de la commande')

@section('contents')
    <h1>Détail de la commande</h1>
    @unless(empty($pizzas))
        <h2 style="text-align: center">
            Nom du client : {{ $user }}
        </h2>
        <table>
            <tr>
                <th>NOM</th>
                <th>PRIX</th>
                <th>QUANTITY</th>
            </tr>
            @foreach ($pizzas as $pizza)
                <tr>
                    <td>{{ $pizza->nom }}</td>
                    <td>{{ $pizza->prix }} <strong>$</strong> </td>
                    <td>
                        {{ \App\Models\CommandePizza::where(['pizza_id' => $pizza->id, 'commande_id' => $commande_id])->first()->qte }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" style="color: #228b22;font-weight: bold;font-size: 25px">
                    Le Prix Total : {{ $prix }} $
            </tr>
        </table>
    @endunless
    <a href="{{ route('list_commandes') }}"> Revenir</a>
@endsection
