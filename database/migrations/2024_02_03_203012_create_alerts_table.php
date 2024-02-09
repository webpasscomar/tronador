<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertsTable extends Migration
{
    public function up()
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('summary');
            $table->datetime('date');
            $table->foreignId('institution_id')->constrained('institution');
            $table->string('owner');
            $table->tinyInteger('status')->default(1);    
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('alerts');
    }
}
