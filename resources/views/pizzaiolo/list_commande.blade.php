@extends('trame.modele')

@section('title', 'Liste des commandes non-traitées')

@section('contents')
    <ul>
        <li><a class="active" href="{{ route('list_commandes') }}">Home</a></li>
        <li style="float:right"> <a href="{{ route('logout') }}">Déconnexion</a>
        </li>
    </ul>
    <p style="color: yellowgreen; font-size: 25px;text-align: center">
        Salut <strong>{{ Auth::user()->prenom }}</strong>
        - Votre ID is : {{ Auth::id() }}
    </p>
    <h1>Liste des commandes non-traitées</h1>
    @unless(empty($commandes))
        <table>
            <tr>
                <th>ID</th>
                <th>STATUT</th>
                <th>CREATED_AT</th>
                <th>DETAIL</th>
                <th>CHANGER LE STATUT</th>
            </tr>
            @foreach ($commandes as $commande)
                <tr>
                    <td style="font-weight: bold">{{ $commande->id }}</td>
                    <td>{{ $commande->statut }}</td>
                    <td>{{ $commande->created_at }}</td>
                    <td><a class="bouncy" style="background-color:#228B22"
                            href="{{ route('detail_commandes', ['id' => $commande->id]) }}"> Regarder
                        </a>
                    </td>
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
