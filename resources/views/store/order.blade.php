@extends('welcome')

@section('content')
<div class="container">

    <form action="{{url('/createorder')}}" method="POST">
        @method('POST')

        @csrf
        <input  type="hidden" value="{{$order->product_id}}" name="product_id" id="product_id" readonly>
        <input  type="hidden" value="{{$order->product_name}}" name="product_name" id="product_name" readonly>
        <input  type="hidden" value="{{$order->product_value}}" name="product_value" id="product_value" readonly>
        <input  type="hidden" value="{{$order->customer_name}}" name="customer_name" id="customer_name" readonly>
        <input  type="hidden" value="{{$order->customer_surname}}" name="customer_surname" id="customer_surname" readonly>
        <input  type="hidden" value="{{$order->customer_email}}" name="customer_email" id="customer_email" readonly>
        <input  type="hidden" value="{{$order->customer_mobile}}" name="customer_mobile" id="customer_mobile" readonly>
    
        <div class="row">
            <div class="col-sm">
                <h1>Por favor Confirme los Datos Suministrados</h1>
                <h1>Producto: {{$order->product_name}}</h1>
                <h2>Valor: ${{$order->product_value}} COP</h2>
                <h3>Nombre: {{$order->customer_name}}</h3>
                <h3>Email: {{$order->customer_email}}</h3>
                <h3>Celular: {{$order->customer_mobile}}</h3>
            </div>
            <div class="col-sm">
                <img class="img-product" src="{{$order->product_image}}" alt="{{$order->product_name}}">
                <br><br>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Continuar</button>
            </div>
        </div>

    </form>



  {{--   <br>
    
    <div class="row">
        <div class="col-sm border">
           {{--  <h4>{{$product->name}}</h4> 
            <p>{{$product->description}}</p>
            <h5>$ {{$product->value}} COP</h5>
        </div>
        <div class="col-sm border">
            <img class="img-product" src="{{$product->url_image}}" alt="{{$product->name}}">
        </div>
    </div>

    <br> --}}
    

</div>
@endsection