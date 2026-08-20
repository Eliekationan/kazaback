<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('host_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->enum('kyc_status', ['none', 'pending', 'verified', 'rejected'])->default('none');
            $table->enum('kyc_document_type', ['cni', 'passeport', 'attestation_identite'])->nullable();
            $table->string('kyc_document_number', 60)->nullable();
            $table->string('kyc_document_path')->nullable();
            $table->timestamp('kyc_verified_at')->nullable();
            $table->foreignId('kyc_verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('payout_phone', 20)->nullable();
            $table->text('bio')->nullable();
            $table->decimal('response_rate', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('host_profiles');
    }
};
