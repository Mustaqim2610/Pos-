<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'POS System')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            🏪 POS SYSTEM
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button class="btn btn-light btn-sm">
                Logout
            </button>

        </form>

    </div>

</nav>

<div class="container mt-5">

    @yield('content')

</div>

</body>

</html>