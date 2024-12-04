<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('inicio') }}">Mi Tienda</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('inicio') }}">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('pedidos')}}">Pedidos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cesta') }}">Cesta ({{sizeof(Auth::user()->productosCarrito())}})</a>
                </li>
                <li class="nav-item">
                    <span class="navbar-text">{{ Auth::user()->name }}</span>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cerrar')}}">Salir</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- mensajes -->
        <div>
            <!-- define una parte variable de la página-->
            @yield('error')
            @yield('info')
        </div>

        <!-- main content es el contenido que va a variar de la página -->
        <div>
            @yield('main')
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
