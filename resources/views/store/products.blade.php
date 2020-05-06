@extends('welcome')

@section('content')
<div class="container">

    @foreach ($products as $item)
        <br>
        <div class="row">
            <div class="col-sm border border-dark rounded">
                <h4>{{$item->name}}</h4>
                {{-- <p>{{$item->description}}</p> --}}
                <h5>$ {{$item->value}} COP</h5>
                <a class="btn btn-primary" href="{{route('product', ['id_product' => $item->id])}}">Más Información</a>
            </div>
            <div class="col-sm border border-dark rounded">
                <img class="img-product" src="{{$item->url_image}}" alt="{{$item->name}}">
            </div>
        </div>
    @endforeach

</div>
@endsection