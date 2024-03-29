<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesRecetaPivotTable extends Migration
{
    
    public function up()
    {
        Schema::create('likes_receta', function (Blueprint $table) {
            $table->engine=('InnoDB');
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('receta_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('likes_receta');
    }
}
