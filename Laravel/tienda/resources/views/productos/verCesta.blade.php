@extends('plantilla')
<!-- si existe esa varibale de sesion: -->
@if(session('mensaje')){
@section('info')
<h3 class="text-success">{{session('mensaje')}}</h3>

}
@endif
@if(session('error')){
@section('info')
<h3 class="text-danger">{{session('error')}}</h3>
}
@endif

@section('main')
<form action="{{route('crearPedido')}}" method="post">
    @csrf
    <button type="submit">Comprar </button>
</form>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Producto</th>
            <th>Precio Unitario</th>
            <th>Precio Total</th>
            <th>Cantidad</th>
            <th>Imagen</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productosC as $p)
        <tr>
            <form action="{{ route('tratarCarrito', [$p->id])}}" method="post">
                @csrf
                <td>{{ $p->id }}</td>
                <td>{{ $p->producto->nombre }}</td>
                <td>{{ $p->precioU }}</td>
                <td><input type="number" min="1" name="cantidad" onchange="submit()" value="{{$p->cantidad}}"></td>
                <td>{{ $p->cantidad * $p->precioU }}</td>
                <td>
                    <img src="{{ asset('img/productos/' . $p->producto->imagen) }}" alt="cesta" width="30px">
                </td>
                <td>
                    <button type="submit" name="btnBorrar" value="{{ $p->id }}">
                        eliminar
                    </button>
                </td>
            </form>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection




