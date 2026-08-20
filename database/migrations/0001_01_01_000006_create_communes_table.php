<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('communes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80);
            $table->string('city', 80);
            $table->string('region', 80)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('communes');
    }
};
