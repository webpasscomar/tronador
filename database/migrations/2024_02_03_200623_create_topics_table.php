<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateTopicsTable extends Migration
    {
        public function up()
        {
            Schema::create('topics', function (Blueprint $table) {
                $table->id();
                $table->string('nombre');
                $table->string('name');
                $table->integer('status')->default(1);
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('topics');
        }
    }
