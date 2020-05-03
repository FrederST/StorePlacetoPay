@extends('welcome')

@section('content')

<div class="container">


    <div class="row">
        <div class="col-sm">
            <h1>Orden # {{$orderSQL->id}}</h1>
            <h1>Producto:</h1>
            <h2>Valor: $ COP</h2>
            <h3>Nombre: {{$orderSQL->customer_name}} {{$orderSQL->customer_surname}}</h3>
            <h3>Email: {{$orderSQL->customer_email}}</h3>
            <h3>Celular: {{$orderSQL->customer_mobile}}</h3>
            @if ($orderSQL->status == 2)
                <h3>Pago Exitoso</h3>
            @else
                <h3>Ocurrio Un Error En EL Pago</h3>
            @endif
        </div>
    </div>


    {{-- <table class="table">
        <thead>
          <tr>
            <th scope="col">ID Orden</th>
            <th scope="col">Nombre</th>
            <th scope="col">Estado</th>
            <th scope="col">Fecha</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">{{$orderSQL->id}}</th>
            <td>{{$orderSQL->customer_name}}</td>
            <td>{{$orderSQL->status}}</td>
            <td>{{$orderSQL->created_at}}</td>
          </tr>
        </tbody>
      </table> --}}

</div>

@endsection