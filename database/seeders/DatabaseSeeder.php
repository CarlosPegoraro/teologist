<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Limpa o banco de dados (opcional, mas recomendado para desenvolvimento)
        // \Illuminate\Support\Facades\DB::statement('PRAGMA foreign_key_constraints=off');
        // Author::truncate();
        // Category::truncate();
        // \App\Models\Blog::truncate();
        // \App\Models\BlogContent::truncate();
        // Post::truncate();
        // \App\Models\Comment::truncate();
        // User::truncate();
        // \Illuminate\Support\Facades\DB::statement('PRAGMA foreign_key_constraints=on');

        $mainUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        User::factory(10)->create();

        Category::factory(15)->create();

        Author::factory(5)
            ->has(\App\Models\Blog::factory()->count(3))
            ->create();

        Post::factory(30)
            ->recycle(User::all())
            ->create();

        // Cria 100 comentários. Cada comentário será associado a um post e a um usuário aleatório.
        \App\Models\Comment::factory(100)
            ->recycle(User::all())
            ->recycle(Post::all())
            ->create();

        $this->call(RoleSeeder::class);

        $this->command->info('Database seeded successfully!');
        $this->command->info('Main user created:');
        $this->command->info('Email: test@example.com');
        $this->command->info('Password: password');
    }
}
