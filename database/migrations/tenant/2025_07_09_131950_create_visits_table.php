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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('ip')->nullable();                // IP del visitante
            $table->string('user_agent')->nullable();        // Navegador o dispositivo
            $table->string('url')->nullable();               // URL visitada
            $table->string('referrer')->nullable();          // Desde dónde llegó
            $table->string('tenant')->nullable();            // Si estás en un sistema multitenant
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
