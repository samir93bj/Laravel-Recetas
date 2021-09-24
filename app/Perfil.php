<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    /* RELACION DE UNO A UNO USUARIO - PERFIL */
    public function usuario(){
        return $this->belongsTo(user::class,'user_id');
    }
}
 