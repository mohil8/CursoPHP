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
            <th>Producto</th>
            <th>Precio Unitario</th>
            <th>Precio Total</th>
            <th>Cantidad</th>
            <th>Imagen</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach ($pedidos as $p){
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->producto->nombre }}</td>
                <td>{{ $p->precioU }}</td>
                <td> {{$p->cantidad}} </td>
                <td>{{ $p->cantidad * $p->precioU }}</td>
                <td>
                    <img src="{{ asset('img/productos/' . $p->producto->imagen) }}" alt="cesta" width="30px">
                </td>
               
            </tr>
            }
            @endforeach
    </tbody>
</table>

@endsection



