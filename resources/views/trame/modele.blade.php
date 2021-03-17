<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <style>
        table,
        th,
        td {
            border: 1px solid violet;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 3px;
        }

        table {
            margin: 50px;
        }

        .etat {
            color: red;
            font-weight: bold;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        h1 {
            text-align: center;
            color: #6595ED;
            font-size: 45px;
        }

        .w-5 {
            display: none;
        }

        h3{
            color: teal;
        }

        h2{
            color : #d2691e
        }

    </style>
</head>

<body>

    @auth
        <a href="{{ route('logout') }}">Déconnexion</a>
        <p style="color: yellowgreen; font-size: 30px">Salut {{ Auth::user()->login }} - Votre ID is : {{ Auth::id() }} </p>
    @endauth

    @section('etat')
        @if (session()->has('etat'))
            <p class="etat">{{ session()->get('etat') }}</p>
        @endif
    @show

    @section('errors')
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    @show

    @yield('contents')
</body>

</html>
