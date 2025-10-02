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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->boolean('status')->default(true);
            $table->string('github_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('account_type');

            // SEO Fields
            $table->string('profile_title')->nullable();
            $table->text('bio')->nullable();
            $table->string('meta_description', 160)->nullable();
            $table->string('avatar')->nullable();
            $table->string('avatar_alt')->nullable();
            $table->integer('profile_views')->default(0);

            // Indexes
            $table->index('slug');
            $table->index('account_type');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
