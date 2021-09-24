<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    
    public function run()
    {
        $user = User::create([
            'name' => 'Juan',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'url' => 'https://www.recetas.com',
        ]);

         //$user->perfil()->create();
    }
}
