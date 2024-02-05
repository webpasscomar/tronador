<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicadoresTable extends Migration
{
    public function up()
    {
        Schema::create('indicadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organismo_id')->constrained('organismos');
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('color', 7); // Valor RGB
            $table->enum('frecuencia', ['Semanal', 'Mensual', 'Trimestral', 'Variable']);
            $table->integer('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('indicadores');
    }
}
