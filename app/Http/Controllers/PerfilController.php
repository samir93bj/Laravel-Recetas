<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{   
    public function __construct()
    {   
            $this->middleware('auth');
    }
    
    //MOSTRAR PERFIL DEL USUARIO
    public function show(Perfil $perfil)
    {
        $recetas = Receta::where('user_id',$perfil->user_id)->paginate(3);

        return view('perfiles.show',compact('perfil','recetas'));
    }


    //FUNCION PARA MOSTRAR VISTA EDITAR
    public function edit(Perfil $perfil)
    {
        //REVISAR POLICY
        $this->authorize('view', $perfil);

        return view('perfiles.edit',compact('perfil'));
    }

    //FUNCION PARA ACTUALIZAR PERFIL
    public function update(Request $request, Perfil $perfil)
    {

        //REVISAR POLICY
        $this->authorize('update', $perfil);

       //VALIDAR
            $data = request()->validate([
                'nombre' => 'required',
                'url' => 'required',
                'biografia' => 'required',
            ]);

        //SI EL USUARIO SUBE UNA IMAGEN
            if($request['imagen']){
                //OBTENEMOS RUTA DE IMAGEN
                $ruta_imagen = $request['imagen']->store('upload-perfiles','public');
                
                //RESIZE DE IMAGEN
                $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(600, 600);
                $img->save();

                //CREAR UN ARREGLO DE IMAGEN
                $array_imagen = ['imagen' => $ruta_imagen];

            }

        //ASIGNAR NOMBRE Y URL
            auth()->user()->name = $data['nombre'];
            auth()->user()->url = $data['url'];
            auth()->user()->save();

        //ELIMINAMOS URL Y NAME DEL $data    
            unset($data['url']);
            unset($data['nombre']);

        //ASIGNAMOS BIOGRAFIA E IMAGEN
            auth()->user()->perfil()->update(array_merge(
                $data,
                $array_imagen ?? []
            ));

       //REDIRECCIONAR
       return redirect()->route('recetas.index');
    }

} 
