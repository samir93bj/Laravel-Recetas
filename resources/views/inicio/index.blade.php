@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
@endsection

@section('hero')
    <div class="hero-categorias" style="background-image: url('/images/bgimagen.jpg')">
        <form action="{{route('buscar.show')}}" class="container h-100" action="">
            <div class="row h-100 align-items-center">
                <div class="col-md-4 texto-buscar">
                    <p class="display-4">Encuentra una receta para tu proxima comida</p>
                    <input type="search" name="buscar" class="form-control" placeholder="Buscar Receta">
                </div>    
            </div>
        </form>
    </div>
@endsection

@section('content')

    <div class="container nuevas-recetas">
        <h2 class="titulo-categoria text-center text-uppercase mb-4">Ultimas Recetas</h2>

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
    </div>

    @foreach ($recetasCats as $recetaCat => $grupo)
        <div class="container">
            <h2 class="titulo-categoria text-uppercase">{{ $recetaCat }}</h2>
            <div class="row mb-4">
                @foreach ($grupo as $recetas)
                    @foreach ($recetas as $receta)
                        <div class="col-md-4 mt-4 mb-6">
                            <div class="card shadow mb-6">
                                <img class="card-img-top" src="/storage/{{$receta->imagen}}" alt="imagen receta">
                                <div class="card-body">
                                    <h3 class="card-title px-3 pt-2 ">{{$receta->titulo}}</h3>

                                    <div class="meta-receta d-flex px-3 justify-content-lg-between">
                                        @php
                                            $fecha = $receta->created_at
                                        @endphp

                                        <p class="text-primary fecha font-weight-bold">
                                            <fecha-receta fecha="{{$fecha}}"></fecha-receta>
                                        </p>
                                        <p class="">{{count($receta->likes)}} Les Gusto</p>
                                    </div>  

                                    <p class="px-2">{{Str::words(strip_tags($receta->preparacion), 20 , '...')}}</p>
                                    <a href="{{route('recetas.show',['receta'=>$receta->id])}}" class="btn btn-primary d-block btn-receta"> Ver Receta</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    @endforeach
@endsection