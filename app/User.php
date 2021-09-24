<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    
    protected $fillable = [
        'name', 'email', 'password','url'
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];
 
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //SE EJECUTA EL SIGUIENTE EVENTO CUANDO SE CREO EL USUARIO 
    protected static function boot(){
        parent::boot();

        //Asignar Perfil una vez q se haya creado un usuario
        static::created(function ($user){
            $user->perfil()->create();
        });

    } 

    /* RELACION DE UNO A MUCHOS USUARIO - RECETAS */
    public function recetas(){
        return $this->hasMany(Receta::class);
    }

    /* RELACION DE UNO A UNO USUARIO - PERFIL */
    public function perfil(){
        return $this->hasOne(Perfil::class);
    }

     /* RELACION DE MUCHOS A MUCHOS LIKES EN RECETAS*/
     public function meGusta(){
        return $this->belongsToMany(Receta::class, 'likes_receta');
    }
} 
