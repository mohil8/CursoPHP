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
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Imagen</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $p)
        <tr>
        <td>{{$p->id}}</td>
        <td>{{$p->nombre}}</td>
        <td>{{$p->precio}}</td>
        <td>{{$p->stock}}</td>
        <td><img src="{{asset('img/productos/'.$p->imagen)}}" alt="{{$p->id}}" width="100px"></td>
        <td>

            <form action="{{route('addCarrito'),$p->id}}" method="post" >
                @csrf
                <button type="submit" value="{{$p->id}}" name="btnAdd">
                    <img src="{{asset('img/carrito.png')}}" alt="cesta" width="20px">
                </button>
            </form>
        </td>
    </tr>
        @endforeach
    </tbody>
</table>
@endsection
