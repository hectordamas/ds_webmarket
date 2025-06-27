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
            $table->string('first_name');           // Nombre
            $table->string('last_name');            // Apellidos
            $table->string('phone');                 // Teléfono (ejemplo: +58 412-3799271)
            $table->string('email')->nullable();    // Correo electrónico, opcional
            $table->text('address');                 // Dirección completa
            $table->string('address_details')->nullable(); // Departamento, habitación, etc (opcional)
            $table->string('delivery_zone')->nullable();   // Zona de entrega
            $table->enum('order_type', ['Delivery', 'Pickup']); // Tipo de pedido: delivery o pickup
            $table->text('order_notes')->nullable();  // Notas del pedido, opcional
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
