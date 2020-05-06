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

      {{-- <div class="row">
        <div class="col-sm">
          <div class="form-group">
            <label for="customer_name">Nombre</label>
            <input @auth value=" {{ Auth::user()->name }}" @else value="{{ old('customer_name') }}" @endauth type="text" class="form-control" name="customer_name"
              id="customer_name" placeholder="Nombre" required>
          </div>
        </div>
        <div class="col-sm">
          <div class="form-group">
            <label for="customer_surname">Apellido</label>
            <input @auth value=" {{ Auth::user()->surname }}" @else value="{{ old('customer_surname') }}" @endauth value="{{ old('customer_surname') }}" type="text" class="form-control" name="customer_surname"
              id="customer_surname" placeholder="Apellido" required>
          </div>
        </div>

        <div class="row">
          <div class="col-sm">
            <div class="form-group">
              <label for="customer_email">Email</label>
              <input @auth value=" {{ Auth::user()->email }}" @else value="{{ old('customer_email') }}" @endauth type="email" class="form-control" name="customer_email"
                id="customer_email" aria-describedby="emailHelp" placeholder="Email@example.com" required>
            </div>
          </div>
          <div class="col-sm">
            <div class="form-group">
              <label for="exampleInputPassword1">Celular</label>
              <input @auth value=" {{ Auth::user()->mobile }}" @else value="{{ old('customer_mobile') }}" @endauth type="tel" class="form-control" name="customer_mobile"
                id="customer_mobile" placeholder="# Celular" required>
            </div>
          </div>
        </div> --}}

        <button type="submit" class="btn btn-primary">Continuar Con La Compra</button>
    </form>

  </div>
@endsection