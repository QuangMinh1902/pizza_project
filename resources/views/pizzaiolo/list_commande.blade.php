@extends('trame.modele')

@section('title', 'Liste des commandes non-traitées')

@section('contents')
    <h1>Liste des commandes non-traitées</h1>
    @unless(empty($commandes))
        <table>
            <tr>
                <th>ID</th>
                <th>STATUT</th>
                <th>PRIX_TOTAL</th>
                <th>CREATED_AT</th>
                <th>DETAIL</th>
                <th>CHANGER LE STATUT</th>
            </tr>
            @foreach ($commandes as $commande)
                <tr>
                    <td>{{ $commande->id }}</td>
                    <td>{{ $commande->statut }}</td>
                    <td>{{ $commande->prix_total }}</td>
                    <td>{{ $commande->updated_at }}</td>
                    <td><a href="{{ route('detail_commandes', ['id' => $commande->id]) }}"> Regarder</a> </td>
                    <td>
                        <form action="{{ route('statut', ['id' => $commande->id]) }}">
                            <label for="statut">Choisir un statut:</label>
                            <select name="statut">
                                <option value="traitement">traitement</option>
                                <option value="pret">pret</option>
                                <option value="recupere">recupere</option>
                            </select>
                            <input type="submit" value="Save">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @endunless
@endsection
