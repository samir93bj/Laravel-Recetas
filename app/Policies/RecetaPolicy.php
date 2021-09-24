<?php

namespace App\Policies;

use App\Receta;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecetaPolicy
{
    use HandlesAuthorization;

   
    public function viewAny(User $user)
    {
        //
    }

 
    public function view(User $user, Receta $receta)
    {
        //VERIFICAMOS AUTENTICIDAD DEL USUARIO
        return $user->id === $receta->user_id;
    }

  
    public function create(User $user)
    {
        //
    }

    
    public function update(User $user, Receta $receta)
    {
        //VERIFICAMOS AUTENTICIDAD DEL USUARIO
        return $user->id === $receta->user_id;
    }

    
    public function delete(User $user, Receta $receta)
    {
         //VERIFICAMOS AUTENTICIDAD DEL USUARIO
         return $user->id === $receta->user_id;
    }

    
    public function restore(User $user, Receta $receta)
    {
        //
    }

    public function forceDelete(User $user, Receta $receta)
    {
        //
    }
}
