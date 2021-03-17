@extends('trame.modele')

@section('title', 'Liste des Pizzas')

@section('contents')
    <h1>Liste des Pizzas</h1>
    <h2><a href={{ 'pizzas/create' }}> Ajouter une nouvelle pizza</a></h2>
    @unless(empty($pizzas))
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
            @foreach ($pizzas as $pizza)
                <tr>
                    <td>{{ $pizza->id }}</td>
                    <td>{{ $pizza->nom }}</td>
                    <td>{{ $pizza->description }}</td>
                    <td>{{ $pizza->prix }}</td>
                    <td>{{ $pizza->created_at }}</td>
                    <td>{{ $pizza->updated_at }}</td>
                    <td>{{ $pizza->deleted_at }}</td>
                    <td><a href="{{ route('pizzas.edit', ['id' => $pizza->id]) }}">Modifier</a></td>
                </tr>
            @endforeach
        </table>
    @endunless

@endsection
