@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Tus Ordenes</h3></div>

                <a class="btn btn-primary" href="{{ url('/allorders') }}">Para Ver Todas Las Ordenes (De La Tienda) Click Aquí</a>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- You are logged in! --}}

                    <table class="table" id="ordersHome" class="table table-hover table-condensed">
                        <thead>
                        
                        <tr>
                            <th>Id</th>
                            <th>Producto</th>
                            <th>Valor</th>
                            <th>Estado</th>
                            <th>&nbsp;</th>
                        </tr>
                
                        </thead>
                    </table>


                </div>
            </div>
        </div>
    </div>

</div>


@endsection
