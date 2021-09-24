@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" />
@endsection

@section('botones')
    <a href="{{ route('recetas.index') }}" class="btn btn-primary mr-2 text-white">Volver</a>
@endsection


@section('content')
    <h1 class="text-center">EDITAR MI PERFIL</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-white p-3">

            <form action="{{ route('perfiles.update',['perfil' => $perfil]) }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                <!--NOMBRE DEL USUARIO-->
                <div class="form-group">
                    <label for="nombre" class="font-weight-bold">NOMBRE</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" id="nombre" placeholder="Tu Nombre" value="{{$perfil->usuario->name}}">

                    @error('nombre')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <!-- IMAGEN DEl USUARIO -->
                <div class="form-group mt-3">
                    @if($perfil->imagen)
                        <div>
                            <p class="mt-3 font-weight-bold">TU FOTO ACTUAL</p>
                             <img src="/storage/{{$perfil->imagen}}" style="width: 400px" alt=""> 
                        </div>

                            @error('imagen')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                    @endif
                    <label for="imagen" class="font-weight-bold">ELEGIR FOTO</label>
                    <input id="imagen" type="file" class="form-control @error('imagen') is-invalid @enderror" name="imagen">
                </div>

                <!-SITIO WEB-->
                <div class="form-group">
                    <label for="url" class="font-weight-bold">URL</label>
                    <input type="text" name="url" class="form-control @error('url') is-invalid @enderror" id="url" placeholder="Tu sitio web" value="{{$perfil->usuario->url}}">

                    @error('url')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <!--BIOGRAFIA DEL USUARIO-->
                <div class="form-group mt-3 font-weight-bold">
                    <label for="biografia">BIOGRAFIA</label>
                    <input type="hidden" name="biografia" id="biografia" value="{{$perfil->biografia}}">

                    <trix-editor input="biografia" class="form-control @error('biografia') is-invalid @enderror"></trix-editor>

                    @error('biografia')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>  

                <!--BOTON PARA GUARDAR RECETA-->
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Actualizar Perfil">
                </div>

            </form>

        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" defer></script>
@endsection 