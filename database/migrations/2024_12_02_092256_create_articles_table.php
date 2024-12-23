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
        Schema::create('articles', function (Blueprint $table) {
            $table->id(); 
            $table->string('title', 255);
            $table->string('image'); 
            $table->text('description')->nullable(); 
            $table->text('content')->nullable(); 
            $table->string('file_path')->nullable(); 
            $table->foreignId('user_id')->nullable(); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
