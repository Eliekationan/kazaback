<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12)->unique();
            $table->foreignId('listing_id')->constrained();
            $table->foreignId('guest_id')->constrained('users');
            $table->foreignId('host_id')->constrained('users');
            $table->date('check_in');
            $table->date('check_out');
            $table->smallInteger('nights');
            $table->decimal('price_per_night_snapshot', 10, 0);
            $table->decimal('subtotal', 10, 0);
            $table->decimal('service_fee', 10, 0);
            $table->decimal('total_amount', 10, 0);
            $table->string('currency', 3)->default('XOF');
            $table->enum('status', [
                'pending', 'confirmed', 'checked_in', 'completed',
                'cancelled_by_guest', 'cancelled_by_host', 'rejected',
            ])->default('pending');
            $table->enum('cancellation_policy', ['flexible', 'moderee', 'stricte']);
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('checked_in_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->string('cancellation_reason')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
