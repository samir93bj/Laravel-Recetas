<?php

namespace App\Policies;

use App\Perfil;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PerfilPolicy
{
    use HandlesAuthorization;

    
    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Perfil $perfil)
    {
        //Revisa si el usuario autenticado es el q desea modificar el perfil
        return $user->id === $perfil->user_id;
    }

   
    public function create(User $user)
    {
        //
    }

    
    public function update(User $user, Perfil $perfil)
    {
        //Revisa si el usuario autenticado es el q desea modificar el perfil
        return $user->id === $perfil->user_id;
    }

    
    public function delete(User $user, Perfil $perfil)
    {
        //
    }

    public function restore(User $user, Perfil $perfil)
    {
        //
    }

    
    public function forceDelete(User $user, Perfil $perfil)
    {
        //
    }
}
