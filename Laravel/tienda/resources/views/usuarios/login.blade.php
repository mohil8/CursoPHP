<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- Agregar Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Contenedor principal para centrar el formulario -->
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <img src="{{asset('img/captura.png')}}"  alt="">

        <div class="col-md-4">
            <!-- Formulario -->
            <form action="{{route('loguear')}}" method="post" class="border p-4 rounded shadow-sm">
                @csrf
                <h2 class="text-center mb-4">Login</h2>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" />
                    @error('email')
                        <p class="text-danger">{{$message}} </p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ps">Contraseña</label>
                    <input type="password" name="ps" id="ps" class="form-control" required />
                    @error('ps')
                        <p class="text-danger">{{$message}} </p>
                    @enderror
                </div>

                <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                
                @if(session('mensaje'))
                  <p class="text-danger"> * {{session('mensaje')}} </p>
                @endif
                <div class="text-center mt-3">
                    <a href="{{route('vistaRegistro')}}">¿No tienes cuenta? Registrarse</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Agregar Bootstrap JS y Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<
