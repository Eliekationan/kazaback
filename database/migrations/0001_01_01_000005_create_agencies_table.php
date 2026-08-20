<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_user_id')->constrained('users')->cascadeOnDelete();
            $table->string('name', 150);
            $table->string('registration_number', 60);
            $table->string('registration_doc_path')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->enum('subscription_plan', ['free', 'pro'])->default('free');
            $table->timestamp('subscription_ends_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agencies');
    }
};
