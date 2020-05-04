@extends('welcome')

@section('content')
<div class="container">

    <form action="{{url('/createorder')}}" method="POST">
        @method('POST')

        @csrf
        <input  type="hidden" value="{{$product->id}}" name="product_id" id="product_id" readonly>
        {{-- <input  type="hidden" value="{{$user->customer_name}}" name="customer_name" id="customer_name" readonly>
        <input  type="hidden" value="{{$user->customer_surname}}" name="customer_surname" id="customer_surname" readonly>
        <input  type="hidden" value="{{$user->customer_email}}" name="customer_email" id="customer_email" readonly>
        <input  type="hidden" value="{{$user->customer_mobile}}" name="customer_mobile" id="customer_mobile" readonly> --}}
    
        <div class="row">
            <div class="col-sm">
                <h1>Por favor Confirme los Datos:</h1>
                <h1>Producto: {{$product->name}}</h1>
                <h2>Valor: $ {{$product->value}} COP</h2>
                <h3>Nombre: {{$user->name}} {{$user->surname}}</h3>
                <h3>Email: {{$user->email}}</h3>
                <h3>Celular: {{$user->mobile}}</h3>
            </div>
            <div class="col-sm">
                <img class="img-product" src="{{$product->url_image}}" alt="{{$product->name}}">
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