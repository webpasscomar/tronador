<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrailsTable extends Migration
{
    public function up()
    {
        Schema::create('trails', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('name');
            $table->text('resumen');
            $table->text('summary');
            // $table->foreignId('indicador_id')->constrained('indicadores');
            $table->string('image');
            $table->string('dificultad');
            $table->string('difficulty');
            $table->string('kms');
            $table->string('elevation'); 
            $table->string('duracion');
            $table->string('duration');
            $table->string('periodo');
            $table->string('period');
            $table->string('geom'); // Puedes cambiar el tipo según el tipo de dato GIS que uses
            $table->integer('order');
            $table->tinyInteger('status')->default(1);    
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trails');
    }
}
