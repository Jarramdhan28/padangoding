<?php

use App\Enums\ArticleStatus;
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
        Schema::create('articles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug')->unique();
            $table->string('thumbnail')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('content');
            $table->foreignUuid('author_id')->constrained('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignUuid('category_id')->constrained('categories')->cascadeOnUpdate()->restrictOnDelete();
            $table->enum('status', ArticleStatus::cases());
            $table->boolean('is_publish')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
