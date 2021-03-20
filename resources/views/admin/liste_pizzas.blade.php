@extends('trame.modele')

@section('title', 'Liste des Pizzas')

@section('contents')
    <h1>Liste des Pizzas</h1>
    <h2><a href={{ 'pizzas/create' }}> Ajouter</a></h2>

    @forelse ($pizzas as $pizza)
        @if ($loop->first)
            <table>
                <tr>
                    <th>ID</th>
                    <th>NOM</th>
                    <th>DESCRIPTION</th>
                    <th>PRIX</th>
                    <th>CREATED_AT</th>
                    <th>UPDATED_AT</th>
                    <th>DELETED_AT</th>
                    <th colspan="2">OPÉRATION</th>
                </tr>
        @endif
        <tr>
            <td style="font-weight: bold">{{ $pizza->id }}</td>
            <td>{{ $pizza->nom }}</td>
            <td>{{ $pizza->description }}</td>
            <td>{{ $pizza->prix }}</td>
            <td>{{ $pizza->created_at }}</td>
            <td>{{ $pizza->updated_at }}</td>
            <td>{{ $pizza->deleted_at }}</td>
            <td>
                <a class="bouncy" style="background-color:#afeeee"
                    href="{{ route('pizzas.edit', ['id' => $pizza->id]) }}">Modifier
                </a>
            </td>
            <td>Supprimer</td>
        </tr>

        @if ($loop->last)
            </table>
        @endif
    @empty
        <p style="text-align: center; color:red;font-weight: bold;font-size: 20px">
            Il n'y a aucune pizza, cliquer "Ajouter" pour ajouter une nouvelle pizza
        </p>
    @endforelse
@endsection
