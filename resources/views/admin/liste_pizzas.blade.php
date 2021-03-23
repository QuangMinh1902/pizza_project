@extends('trame.modele')

@section('title', 'Liste des Pizzas')

@section('contents')
    <ul>
        <li><a class="active" href="{{ route('pizzas.index') }}">Home</a></li>
        <li><a href={{ 'pizzas/create' }}> Ajouter</a></li>
        <li style="float:right"> <a href="{{ route('logout') }}">Déconnexion</a>
        </li>
    </ul>

    <h1>Liste des Pizzas</h1>

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
                    <th colspan="2">OPÉRATION</th>
                </tr>
        @endif
        <tr>
            <td style="font-weight: bold">{{ $pizza->id }}</td>
            <td>{{ $pizza->nom }}</td>
            <td>{{ $pizza->description }}</td>
            <td>{{ $pizza->prix }} <strong> $</strong></td>
            <td>{{ $pizza->created_at }}</td>
            <td>{{ $pizza->updated_at }}</td>
            <td>
                <a class="bouncy" style="background-color:#0000cd"
                    href="{{ route('pizzas.edit', ['id' => $pizza->id]) }}">Modifier
                </a>
            </td>
            <td>
                <form action="{{ route('pizza.deletePizza', ['id' => $pizza->id]) }}" method="post"
                    onsubmit="return confirm('Are you sure ? ')">
                    @method('delete')
                    @csrf
                    <button>
                        Supprimer
                    </button>
                </form>
            </td>
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
