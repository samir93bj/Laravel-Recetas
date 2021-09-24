<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $fillable = [
        'titulo', 'categoria_id', 'preparacion','ingredientes','imagen'
    ];

        //OBTIENE LA CATEGORIA DE LA RECETA VIA FK
        public function categoria(){
            return $this->belongsTo(CategoriaReceta::class);
        }

        //OBTENER EL USUARIO CREADOR DE LA RECETA 
        public function autor(){
            return $this->belongsTo(User::class, 'user_id'); //En caso de usar FK debemos indicarlo
        }

        //RELACION MUCHOS A MUCHOS DE LIKES
        public function likes(){
            return $this->belongsToMany(User::class,'likes_receta'); 
        }
}
 