<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferencesTable extends Migration
{
    public function up()
    {
        Schema::create('references', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('image');
            $table->string('pdf');
            $table->foreignId('topic_id')->constrained('topics');
            $table->foreignId('trail_id')->constrained('trails');
            $table->foreignId('institution_id')->constrained('institutions');
            $table->tinyInteger('status')->default(1);    
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('references');
    }
}
