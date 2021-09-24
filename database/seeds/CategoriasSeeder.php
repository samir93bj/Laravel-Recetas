<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    
    public function run()
    {
        $names = array('Comida Argentina','Comida Mexicana','Comida Coreana','Comida Italina', 'Postres','Ensaladas');

        foreach($names as $name){
            DB::table('categoria_recetas')->insert([
                'nombre' => $name,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]); 
            }
    }
}
