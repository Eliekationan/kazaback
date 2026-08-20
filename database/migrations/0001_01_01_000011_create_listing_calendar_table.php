<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listing_calendars', function (Blueprint $table) {
            $table->foreignId('listing_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->enum('status', ['available', 'blocked', 'booked'])->default('available');
            $table->decimal('price_override', 10, 0)->nullable();
            $table->primary(['listing_id', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listing_calendars');
    }
};
