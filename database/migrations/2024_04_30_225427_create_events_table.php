<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id()->unique('id');
            $table->string('title');
            $table->string('Type_de_billet');
            $table->text('description')->nullable(); 
            $table->string('image_path')->nullable(); 
            $table->string('location');
            $table->decimal('price', 8, 2);
            $table->integer('duration')->nullable()->default(90);
            $table->dateTime('event_date')->index(); 
            $table->boolean('closed')->default(false);  
            $table->string('map_url',500)->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
