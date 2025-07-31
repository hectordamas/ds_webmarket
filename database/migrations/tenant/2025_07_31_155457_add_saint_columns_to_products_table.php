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
        Schema::table('products', function (Blueprint $table) {
            $table->string('tipofac', 1)->nullable()->after('codinst');
            $table->string('numerod', 50)->nullable()->after('tipofac');
            $table->string('fechae', 20)->nullable()->after('numerod');
            $table->boolean('ensaint')->default(0)->after('fechae');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
