<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InicioController extends Controller
{
    public function index(){

        //obtener las ultimas recetas
        $recetas = Receta::latest()->take(6)->get();

        //Recetas por categoria
        $categorias = CategoriaReceta::all();


        //Agrupar las recetas por categoria
        $recetasCats = [];

        foreach($categorias as $categoria){
            $recetasCats[Str::slug($categoria->nombre) ][] =  Receta::where('categoria_id' , $categoria->id)->take(3)->get();
        }

        return view('inicio.index',compact('recetas','recetasCats'));
    }
    
}
 