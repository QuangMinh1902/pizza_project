@extends('trame.modele')

@section('title', 'Détail de commande')

@section('contents')
    <h1>Détail de la commande</h1>

    @forelse ($pizzas as $pizza)
        @if ($loop->first)
            <table style="margin: auto">
                <tr>
                    <th>Nom de pizza</th>
                </tr>
        @endif
        <tr>
            <td>{{ $pizza->nom }}</td>
        </tr>

        @if ($loop->last)
            </table>
        @endif
    @empty

    @endforelse
    </table>

    <a href="{{ route('liste_commandes', ['id' => Auth::id()]) }}"> Revenir</a>
@endsection
