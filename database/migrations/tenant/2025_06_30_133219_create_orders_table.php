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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // Datos cliente
            $table->string('nombre');
            $table->string('cedula');
            $table->string('telefono');
            $table->text('direccion')->nullable();
            $table->string('detalle_direccion')->nullable();
            $table->string('tipo_pedido'); // delivery, pickup, etc.
            $table->string('metodo_pago');
            $table->json('items')->nullable();
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            
            $table->text('notas')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
