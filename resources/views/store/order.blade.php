@extends('welcome')

@section('content')
<div class="container">

    <form action="{{url('/createorder')}}" method="POST">
        @method('POST')

        @csrf
        <input  type="hidden" value="{{$product->id}}" name="product_id" id="product_id" readonly>
    
        <div class="row">
            <div class="col-sm">
                <h1>Por favor Confirme los Datos:</h1>
                <h1>Producto: {{$product->name}}</h1>
                <h2>Valor: $ {{$product->value}} COP</h2>
                <h3>Nombre: {{$user->name}} {{$user->surname}}</h3>
                <h3>Email: {{$user->email}}</h3>
                <h3>Celular: {{$user->mobile}}</h3>
            </div>
            <div class="col-sm text-center">
                <img class="img-product" src="{{$product->url_image}}" alt="{{$product->name}}">
                <br><br>
                <a class="btn btn-secondary btn-lg btn-block" href="/">Regresar</a>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Confirmar</button>
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