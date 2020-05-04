@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tus Ordenes</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- You are logged in! --}}

                    <table class="table" id="orders" class="table table-hover table-condensed">
                        <thead>
                        
                        <tr>
                            <th>Id</th>
                            <th>Producto</th>
                            <th>Valor</th>
                            <th>Estado</th>
                        </tr>
                
                        </thead>
                    </table>


                </div>
            </div>
        </div>
    </div>

</div>


@endsection
