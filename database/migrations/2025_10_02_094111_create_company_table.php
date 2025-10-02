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
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('company_name');
            $table->string('slug')->unique();
            $table->string('registration_number')->nullable();
            $table->string('industry_type')->nullable();
            $table->string('company_type')->nullable();
            $table->string('website_url')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->bigInteger('new_column')->nullable();

            // SEO Fields
            $table->string('meta_title', 70)->nullable();
            $table->string('meta_description', 160)->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('tagline')->nullable();
            $table->integer('profile_views')->default(0);
            $table->decimal('rating', 3, 2)->default(0.00);
            $table->integer('reviews_count')->default(0);

            // Indexes
            $table->index('slug');
            $table->index('city');
            $table->index('industry_type');
            $table->fullText(['company_name', 'tagline']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
