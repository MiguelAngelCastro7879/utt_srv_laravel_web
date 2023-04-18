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
        Schema::create('videogames', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('category_id'); // Agregar columna category_id
            $table->foreign('category_id')->references('id')->on('categories'); // Agregar llave foránea
            $table->decimal('price', $precision = 5, $scale = 2);
            $table->boolean('status')->default(true);
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videogames');
    }
};
