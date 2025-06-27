<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('key')->unique();
            $table->text('value')->nullable();
        });

        DB::table('settings')->insert([
            ['key' => 'logo', 'value' => 'assets/img/logo-color.png'],
            ['key' => 'whatsapp_human', 'value' => '+58 424-0000000'],
            ['key' => 'whatsapp_url', 'value' => 'https://wa.me/584240000000'],
            ['key' => 'color_primary', 'value' => '#157347'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
