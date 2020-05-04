@extends('welcome')

@section('content')

<div class="container">


    <div class="row">
        <div class="col-sm">
            <h1>Orden # {{$orderSQL->id}}</h1>
            <h1>Producto: {{$productSQL->name}}</h1>
            <h2>Valor: $ {{$productSQL->value}} COP</h2>
            <h3>Nombre: {{$userSQL->name}} {{$userSQL->surname}}</h3>
            <h3>Email: {{$userSQL->email}}</h3>
            <h3>Celular: {{$userSQL->mobile}}</h3>

            @if ($orderSQL->status == 2)
                <h3>Pago Exitoso</h3>
            @elseif ($orderSQL->status == 3)
                <h3>Pago Rechazado</h3>
                <form action="{{url('/order')}}" method="GET">
                  @csrf
                  <input type="hidden" value="{{$orderSQL->product_id}}" name="product_id" id="product_id" readonly>
                  <button type="submit" class="btn btn-primary">Reintentar Compra</button>
                </form>
            @elseif ($orderSQL->status == 4)
                <h3>El Pago Se Encuentra Pendiente O No Ha Sido Aprovado</h3>
                <a class="btn btn-primary" href="{{$orderSQL->processUrl}}">Click Para Más Información</a>
            @else 
                <h3>Ocurrio Un Error</h3>
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