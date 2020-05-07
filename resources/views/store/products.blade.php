@extends('welcome')

@section('content')
<div class="container">

    @foreach ($products as $item)
        <br>
        <div class="row">
            <div class="col-8 border border-dark rounded">
                <div class="row">
                    <div class="col-4">
                        <h4>{{$item->name}}</h4>
                        <h5>$ {{$item->value}} COP</h5>
                        <a class="btn btn-info" data-toggle="collapse" href="#collapse{{$item->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Más Información
                        </a>
                        <br><br>
                        <form action="{{url('/order')}}" method="GET">
                            @csrf
                      
                            <input type="hidden" value="{{$item->id}}" name="product_id" id="product_id" readonly>
                      
                            <button type="submit" class="btn btn-primary">Continuar Con La Compra</button>
                        </form>
                        {{-- <a class="btn btn-primary" href="{{route('product', ['id_product' => $item->id])}}">Comprar</a> --}}
                        
                    </div>
                    <div class="col">
                        <div class="collapse" id="collapse{{$item->id}}">
                            <div class="card card-body">
                                <h5>Descripción</h5>
                                {!!$item->description!!}
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
            </div>
            <div class="col-sm border border-dark rounded d-flex justify-content-center">
                <img class="img-product" src="{{$item->url_image}}" alt="{{$item->name}}">
            </div>
        </div>
    @endforeach



</div>
@endsection