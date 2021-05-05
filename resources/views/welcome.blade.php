<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home | Formations</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .cont {
            width: 100%;
            height: 100vh;
            background-image:url({{url('/img/cover.jpg')}});
            background-size: cover;
        }

        a {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }

        .btn {
             background: linear-gradient(to right, #373b44, #4286f4);
            padding: 0.8rem;
            color: #fff;
            margin-left: 20px;
            border-radius:5px;
        }

        .btn:hover {
            border: none;
            box-shadow: -0.0525rem 0 0.525rem 0 #43c6ac;
            transition: box-shadow 0.5s;
        }

        .menu {
            width: 100%;
            padding: 1rem;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        .title {
            margin-right: auto;
              background: linear-gradient(to right, #373b44, #4286f4);
            font-weight: bolder;
            font-size: 1.75rem;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .link {
            margin-left: auto;
        }

        .nav-link:hover {
            color: #dc3545 !important;
        }

        .corps {
            width: 100%;
            height: 80%;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;

        }

        .corps h1 {
            font-size: 2.5rem;
            margin-bottom: 50px;
        }

    </style>
</head>

<body class="antialiased">
    <div class="cont">
        @if (Route::has('login'))
        <div class="menu">
            <div class="title">
                Formations
            </div>
            <div class="link">
                @auth
                <a href="{{ url('/formation') }}" class="nav-link">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="nav-link">Login</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn">Register</a>
                @endif
                @endauth
            </div>
        </div>
        @endif
        <div class="corps">
            <h1>
                Bienvenu sur notre site decouvrez nos formations ici, vous n'avez qu'a nous rejoindre.
            </h1>
            <div>
                <a href="{{ route('login') }}" class="btn">Click here</a>
            </div>
        </div>
    </div>
</body>

</html>
