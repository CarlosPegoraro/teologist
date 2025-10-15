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
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('site')->nullable();
            $table->string('instagram')->nullable();
            $table->string('phone')->nullable();
            $table->string('about')->nullable();
            $table->string('title')->nullable();
            $table->timestamps();
        });

        // Tabela de categorias
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('description')->nullable();
            $table->string('color')->nullable();
            $table->timestamps();
        });

        // Tabela de blogs (atualizada)
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->string('about');
            $table->string('thumbnail');
            $table->foreignId('author_id')->constrained()->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('blogs_contents', function (Blueprint $table) {
            $table->text('content');
            $table->integer('order');
            $table->foreignId('blog_id')->constrained()->onDelete('cascade');
        });

        Schema::create('blogs_categories', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('blog_id')->constrained()->onDelete('cascade');
            $table->primary(['category_id', 'blog_id']);
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('content');
            $table->integer('likes')->default(0);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->integer('likes')->default(0);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('blogs_categories');
        Schema::dropIfExists('blogs_contents');
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('authors');
    }
};
