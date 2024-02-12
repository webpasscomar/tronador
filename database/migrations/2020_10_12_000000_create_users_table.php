<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable(); 
            $table->string('phone')->nullable();
            $table->date('birthday')->nullable();    
        	$table->tinyInteger('status')->default(1);
            $table->foreignId('institution_id')
				->nullable()
				->constrained('institutions');
            $table->foreignId('nationality_id')
				->nullable()
				->constrained('nationalities');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
