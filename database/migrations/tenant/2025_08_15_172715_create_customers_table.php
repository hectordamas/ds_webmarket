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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre')->nullable();
            $table->string('tipo_documento')->default('V');
            $table->string('cedula')->nullable();
            $table->string('telefono')->nullable();
            $table->text('direccion')->nullable();
            $table->text('detalle_direccion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
