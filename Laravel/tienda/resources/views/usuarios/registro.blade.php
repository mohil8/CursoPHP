<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <!-- Agregar Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Contenedor principal para centrar el formulario -->
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
      <div class="text-center"> <img src="{{asset('img/captura.png')}}" > </div><br>
        <div class="col-md-4">
            <!-- Formulario -->
            <form action="{{route('registrar')}}" method="post" class="border p-4 rounded shadow-sm">
                @csrf
                <h2 class="text-center mb-4">Registrarse</h2>

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" value="{{old('nombre')}}" class="form-control"  />
                @error('nombre')
                 <h3> {{$message}} </h3>
                @enderror
                </div>


                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="{{old('email')}}" class="form-control"  />
                    @error('email')
                    <h3> {{$message}} </h3>
                   @enderror
                </div>

                <div class="form-group">
                    <label for="ps">Contraseña</label>
                    <input type="password" name="ps" class="form-control"  />
                    @error('ps')
                    <h3> {{$message}} </h3>
                   @enderror
                </div>

                <div class="form-group">
                    <label for="ps2">Confirmar Contraseña</label>
                    <input type="password" name="ps2" class="form-control"  />
                    @error('ps2')
                    <h3> {{$message}} </h3>
                   @enderror
                </div>

                <button type="submit" name="crear" class="btn btn-primary btn-block">Crear Cuenta</button>

                <div class="text-center mt-3">
                    <a href="{{route('login')}}">¿Ya tienes cuenta? Iniciar sesión</a>
                @if (session('mensaje'))
                    {{session('mensaje')}}
                @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Agregar Bootstrap JS y Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

