<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapasTable extends Migration
{
    public function up()
    {
        Schema::create('capas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('resumen');
            $table->foreignId('indicador_id')->constrained('indicadores');
            $table->enum('presentacion', ['Vectorial', 'Puntos', 'Poligono']);
            $table->date('fechaDesde');
            $table->date('fechaHasta')->nullable();
            $table->geometry('georeferencial'); // Puedes cambiar el tipo según el tipo de dato GIS que uses
            $table->integer('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('capas');
    }
}
