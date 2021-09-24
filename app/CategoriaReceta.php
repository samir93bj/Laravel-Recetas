<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaReceta extends Model
{
   //OBTIENE LA CATEGORIA DE LA RECETA VIA FK
   public function recetas(){
      return $this->hasMany(Receta::class);
  }
}
 