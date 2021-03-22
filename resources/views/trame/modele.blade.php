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
            padding: 5px;
            text-align: center;
        }

        th {
            color: #b22222
        }

        table {
            margin: auto;
            width: 60%;
            border: 3px solid green;
            padding: 10px;
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

        h3 {
            color: teal;
        }

        h2 {
            color: #d2691e
        }

        a.bouncy {
            animation: bouncy 5s infinite linear;
            position: relative;
            display: inline-block;
            padding: 0.3em 1.2em;
            margin: 0 0.1em 0.1em 0;
            border: 0.16em solid rgba(255, 255, 255, 0);
            border-radius: 2em;
            box-sizing: border-box;
            text-decoration: none;
            font-family: 'Roboto', sans-serif;
            font-weight: 300;
            color: #FFFFFF;
            text-shadow: 0 0.04em 0.04em rgba(0, 0, 0, 0.35);
            text-align: center;
            transition: all 0.2s;
        }

        a.bouncy:hover {
            border-color: rgba(255, 255, 255, 1);
        }

        @keyframes bouncy {
            0% {
                top: 0em
            }

            40% {
                top: 0em
            }

            43% {
                top: -0.9em
            }

            46% {
                top: 0em
            }

            48% {
                top: -0.4em
            }

            50% {
                top: 0em
            }

            100% {
                top: 0em;
            }
        }

        button {
            background-color: #ff1493;
            border-radius: 30px;
            color: white;
            font-size: 18px;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            border: 1px solid #e7e7e7;
            background-color: #f3f3f3;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: #666;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover:not(.active) {
            background-color: #ddd;
        }

        li a.active {
            color: white;
            background-color: #008b8b;
        }

    </style>
</head>

<body>
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
