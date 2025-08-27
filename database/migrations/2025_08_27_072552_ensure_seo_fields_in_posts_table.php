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
        Schema::table('posts', function (Blueprint $table) {
            // Add SEO fields if they don't exist
            if (!Schema::hasColumn('posts', 'meta_title')) {
                $table->string('meta_title')->nullable();
            }
            if (!Schema::hasColumn('posts', 'meta_description')) {
                $table->text('meta_description')->nullable();
            }
            if (!Schema::hasColumn('posts', 'meta_keywords')) {
                $table->text('meta_keywords')->nullable();
            }
            if (!Schema::hasColumn('posts', 'canonical_url')) {
                $table->string('canonical_url')->nullable();
            }
            if (!Schema::hasColumn('posts', 'published_at')) {
                $table->dateTime('published_at')->nullable();
            }
            if (!Schema::hasColumn('posts', 'status')) {
                $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            }
            if (!Schema::hasColumn('posts', 'author')) {
                $table->string('author')->nullable();
            }
            if (!Schema::hasColumn('posts', 'category')) {
                $table->string('category')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn([
                'meta_title',
                'meta_description',
                'meta_keywords',
                'canonical_url',
                'published_at',
                'status',
                'author',
                'category',
            ]);
        });
    }
};
