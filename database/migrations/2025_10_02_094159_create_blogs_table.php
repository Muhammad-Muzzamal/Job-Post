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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('company_id')->nullable()->constrained('company')->onDelete('set null');

            // Basic Content
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->string('featured_image_alt')->nullable();

            // SEO Fields
            $table->string('meta_title', 70)->nullable();
            $table->string('meta_description', 160)->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('canonical_url')->nullable();
            $table->json('og_tags')->nullable(); // Open Graph tags
            $table->json('twitter_tags')->nullable(); // Twitter Card tags
            $table->string('focus_keyword')->nullable();

            // Category & Tags
            $table->string('category')->nullable();
            $table->json('tags')->nullable();

            // Status & Publishing
            $table->enum('status', ['draft', 'published', 'scheduled', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamp('scheduled_at')->nullable();

            // SEO Performance
            $table->integer('read_time')->nullable(); // in minutes
            $table->integer('views_count')->default(0);
            $table->integer('shares_count')->default(0);
            $table->decimal('seo_score', 5, 2)->nullable();

            // Author Info
            $table->string('author_name')->nullable();
            $table->text('author_bio')->nullable();

            // Schema Markup
            $table->json('schema_markup')->nullable();

            // Indexes for SEO
            $table->index('slug');
            $table->index('status');
            $table->index('published_at');
            $table->index('category');
            $table->fullText(['title', 'content']);

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
