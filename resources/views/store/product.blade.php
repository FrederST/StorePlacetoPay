@extends('welcome')

@section('content')
  <div class="container">

    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    
    <br>
    <a class="btn btn-secondary" href="/">Regresar</a>
    <h1>{{$product->name}}</h1>
    <div class="row">
      <div class="col-sm border">
        <h4>Descripción</h4>
        <p>{{$product->description}}</p>
        <h5>$ {{$product->value}} COP</h5>
      </div>
      <div class="col-sm border">
        <img class="img-product" src="{{$product->url_image}}" alt="{{$product->name}}">
      </div>
    </div>

    <br>

    <form action="{{url('/order')}}" method="GET">
      @csrf

      <input type="hidden" value="{{$product->id}}" name="product_id" id="product_id" readonly>

        <button type="submit" class="btn btn-primary">Continuar Con La Compra</button>
    </form>

  </div>
@endsection