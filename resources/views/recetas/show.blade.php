@extends('layouts.app')

@section('botones')
    <a href="{{ route('recetas.index') }}" class="btn btn-primary mr-2 text-white">Volver</a>
@endsection

@section('content')
    <article class="contenido-receta">
        <h1 class="text-center mb-4">{{$receta->titulo}}</h1>

        <div class="receta-meta">

            <!--IMAGEN DE LA RECETA-->
            <div>
                <img src="/storage/{{$receta->imagen}}" class="w-100" alt="">
            </div>

            <!-- Escrito-->
            <p>
                <span class="font-weight-bold text-primary">Escrito en:</span>
                {{$receta->categoria->nombre}}
            </p>

            <!-- fecha-->
            <p>
                <span class="font-weight-bold text-primary">Fecha:</span>
                @php
                    $fecha = $receta->created_at
                @endphp

                <fecha-receta fecha="{{$fecha}}" ></fecha-receta>
            </p>
            

            <!--Autor -->
            <p>
                <span class="font-weight-bold text-primary">Autor:</span>
                {{$receta->autor->name}}
            </p>
            
            <!--Ingredientes -->
            <div class="ingredientes">
                <h2 class="my-3 text-primary">Ingredientes</h2>
                {!! $receta->ingredientes !!}
            </div>

            <!-- Preparacion -->
            <div class="preparacion">
                <h2 class="my-3 text-primary">Preparacion</h2>
                {!! $receta->preparacion !!}
            </div>

            <div class="justify-content-center row text-center">
                <like-button
                    likes="{{$likes}}"
                    like="{{$like}}"
                    receta-id="{{$receta->id}}"
                ></like-button>
            </div>
    
        </div> 
    </article>
@endsection 