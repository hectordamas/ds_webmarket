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
        Schema::create('order_product_options', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('order_product_id')->constrained()->onDelete('cascade');
            $table->string('option_group_name'); // nombre del grupo de opciones, ej: "Aderezos"
            $table->string('option_name');       // nombre de la opción elegida, ej: "Mostaza"
            $table->decimal('price', 10, 2)->default(0); // precio extra si aplica
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product_options');
    }
};
