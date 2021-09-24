@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="titulo-categoria mb-4">
            Resultados Busqueda: <strong class="text-uppercase">{{$busqueda}}</strong>
        </h2>

        <div class="row">
            @foreach ($recetas as $receta)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="/storage/{{$receta->imagen}}" class="card-img-top" alt="imagen receta">

                    <div class="card-body">
                        <h3>{{Str::title ($receta->titulo)}}</h3>

                        <p>{{ Str::words(strip_tags($receta->preparacion), 20)}}</p>

                        <a href="{{ route('recetas.show',['receta' => $receta->id]) }}" class="btn btn-primary d-block font-weight-bold text-uppercase"> Ver Receta</a>
                    </div>
                </div>
            </div>  
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{$recetas->links()}}
        </div>
    </div>
@endsection