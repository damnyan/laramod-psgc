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
        Schema::create('psgc_provinces', function (Blueprint $table) {
            $table->string(column: 'code', length: 10)
                ->primary()
                ->index();
            $table->string(column: 'name');
            $table->string(column: 'region_code', length: 10)
                ->index();
            $table->string(column: 'region_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provinces');
    }
};
