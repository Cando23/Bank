<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    @vite([ 'resources/js/app.js'])
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="{{route('clients.index')}}">Clients</a>
            <a class="nav-item nav-link active" href="{{route('deposits.index')}}">Deposits</a>
            <a class="nav-item nav-link active" href="{{route('credits.index')}}">Credits</a>
            <a class="nav-item nav-link active" href="{{route('operations.index')}}">Operations</a>
            <a class="nav-item nav-link active" href="{{route('atm.index')}}">Atm</a>
        </div>
    </div>
</nav>
<div class="container">
@yield('content')
</div>
</body>
</html>
