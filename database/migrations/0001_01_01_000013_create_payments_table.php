<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->enum('provider', ['orange_money', 'mtn_momo', 'moov_money', 'wave', 'card']);
            $table->string('provider_transaction_id', 100)->nullable();
            $table->enum('type', ['booking_payment', 'payout_to_host', 'refund']);
            $table->decimal('amount', 10, 0);
            $table->string('currency', 3)->default('XOF');
            $table->enum('status', ['pending', 'success', 'failed', 'refunded'])->default('pending');
            $table->enum('escrow_status', ['held', 'released', 'refunded'])->nullable();
            $table->timestamp('held_at')->nullable();
            $table->timestamp('released_at')->nullable();
            $table->json('raw_payload')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
