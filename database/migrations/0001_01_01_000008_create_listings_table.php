<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('host_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('agency_id')->nullable()->constrained('agencies')->nullOnDelete();
            $table->foreignId('commune_id')->constrained('communes');
            $table->string('title', 140);
            $table->text('description');
            $table->enum('type', ['studio', 'appartement', 'villa', 'chambre']);
            $table->unsignedTinyInteger('bedrooms');
            $table->unsignedTinyInteger('beds');
            $table->unsignedTinyInteger('max_guests');
            $table->string('address_text')->nullable();
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->decimal('price_per_night', 10, 0);
            $table->decimal('price_per_week', 10, 0)->nullable();
            $table->decimal('price_per_month', 10, 0)->nullable();
            $table->decimal('cleaning_fee', 10, 0)->default(0);
            $table->decimal('security_deposit', 10, 0)->default(0);
            $table->unsignedTinyInteger('min_stay_nights')->default(1);
            $table->boolean('instant_booking')->default(false);
            $table->enum('status', ['draft', 'pending_review', 'published', 'rejected', 'suspended', 'archived'])->default('draft');
            $table->string('rejection_reason')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
