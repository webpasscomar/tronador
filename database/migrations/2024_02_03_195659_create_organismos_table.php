<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganismosTable extends Migration
{
    public function up()
    {
        Schema::create('organismos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('sigla', 10);
            $table->integer('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('organismos');
    }
}
