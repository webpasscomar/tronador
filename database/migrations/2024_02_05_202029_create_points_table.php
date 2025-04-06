<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('name');
            $table->text('descripcion')->nullable();
            $table->text('description')->nullable();
            $table->string('image');
            $table->string('lat');
            $table->string('lng');
            $table->string('pdf')->nullable();
            $table->foreignId('tipo_id')->constrained('tipos');
            $table->foreignId('trail_id')->constrained('trails');
            $table->foreignId('institution_id')->constrained('institutions');
            $table->tinyInteger('status')->default(1);    
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('points');
    }
}
