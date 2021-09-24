<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{
    //autenticacion obligatoria
        public function __construct(){
            $this->middleware('auth', ['except' => ['show','search']]);
        }

    //INDEX PARA LA VISTA PRINCIPAL
    public function index()
    {

        //OBTENEMOS USUARIO
        $usuario = auth()->user();
        /*OBTENEMOS RECETAS POR USUARIO
        $recetas = auth()->user()->recetas;*/

        //OBTENEMOS RECETAS POR MEDIO DEL MODELO
        //$categorias = CategoriaReceta::all(['id','nombre']);
        
        $recetas = Receta::where('user_id',$usuario->id)->paginate(3);

        return view('recetas.index')->with('recetas',$recetas)
                                    ->with('usuario',$usuario);
    }

   //RENDERIZAR VISTA PARA CREAR RECETA
    public function create()
    {
        //MOSTRAR RESULTADOS EN PANTALLA Y TERMINAR EJECUCION 
        //DB::table('categorias_recetas')->get()->pluck('nombre', 'id')->dd();

        //OBTENER LAS CATEGORIAS
        //$categorias = DB::table('categoria_recetas')->get()->pluck('nombre', 'id');

        //OBTENER CATEGORIAS CON MODELO
        $categorias = CategoriaReceta::all(['id','nombre']);

        return view('recetas.create',compact('categorias'));
    } 

    //FUNCION ALMACENAR RECETA
    public function store(Request $request)
    {
        $data = request()->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image'
        ]);

        //OBTENEMOS RUTA DE IMAGEN
        $ruta_imagen = $request['imagen']->store('upload-recetas','public');
        
        //RESIZE DE IMAGEN
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
        $img->save();

        /*ALMACENAMOS RECETA
        DB::table('recetas')->insert([
            'titulo' => $data['titulo'],
            'ingredientes' => $data['ingredientes'],
            'preparacion' => $data['preparacion'],
            'imagen' => $ruta_imagen,
            'user_id' => Auth::user()->id,
            'categoria_id' => $data['categoria'],
        ]);*/

        //Almacenar en la DB con modelo
        auth()->user()->recetas()->create([
            'titulo' => $data['titulo'],
            'ingredientes' => $data['ingredientes'],
            'preparacion' => $data['preparacion'],
            'imagen' => $ruta_imagen,
            'categoria_id' => $data['categoria'],
        ]);

        //Redireccionar
        return redirect()->action('RecetaController@index');

    }

    //FUNCION PARA MOSTRAR RECETA
    public function show(Receta $receta)
    {
        //Verificar si esta autenticado  y si le dio Me Gusta
        $like = ( auth()->user() ) ? auth()->user()->meGusta->contains($receta->id) : false; // Contains nos permite verificar si se le dio Me gusta a una receta, solo debemos pasarle la receta

        //retornar la cantidad de like por receta
        $likes = $receta->likes->count();

        return view('recetas.show', compact('receta','like','likes'));
    }

    //FUNCION PARA EDITAR RECETA
    public function edit(Receta $receta)
    {   
        //REVISAR POLICY
        $this->authorize('view', $receta);

        $categorias = CategoriaReceta::all(['id','nombre']);

        return view('recetas.edit',compact('categorias','receta'));
    }

    //FUNCION PARA ACTUALIZAR RECETA
    public function update(Request $request, Receta $receta)
    {
        //REVISAR POLICY
        $this->authorize('update', $receta);

        $data = request()->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
        ]);

        /*ASIGNAR LOS VARLORES*/
        $receta->titulo = $data['titulo'];
        $receta->categoria_id = $data['categoria'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->preparacion = $data['preparacion'];

        if(request('imagen')){
            //OBTENEMOS RUTA DE IMAGEN
            $ruta_imagen = $request['imagen']->store('upload-recetas','public');
            
            //RESIZE DE IMAGEN
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
            $img->save();

            //ASIGNAMOS AL OBJETO
            $receta->iamgen = $ruta_imagen;
        }

        $receta->save();

        //REDIRECCIONAR
        return redirect()->route('recetas.show',compact('receta'));
    } 

    //FUNCION PARA ELIMINAR RECETA
    public function destroy(Receta $receta)
    {   
        

        //REVISAR POLICY
        $this->authorize('delete', $receta);

        $receta->delete();
        return redirect()->route('recetas.index');
    } 

    //FUNCION PARA BUSCAR RECETAS
    public function search(Request $request){

        $busqueda = $request['buscar'];
        $recetas = Receta::where('titulo','like','%'.$busqueda.'%')->paginate(10);
        $recetas->appends(['buscar' => $busqueda]);

        return view('busquedas.show',compact('recetas','busqueda'));
    }
}
