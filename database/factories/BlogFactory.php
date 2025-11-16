<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\BlogContent;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'subtitle' => $this->faker->sentence(8),
            'about' => $this->faker->paragraph,
            'thumbnail' => $this->faker->imageUrl,
            'author_id' => Author::factory(),
            'content' => json_encode($this->faker->paragraphs(10, true)),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (\App\Models\Blog $blog) {
            // Cria de 1 a 5 conteúdos para o blog
            BlogContent::factory(rand(1, 5))->create([
                'blog_id' => $blog->id,
            ]);

            // Anexa de 1 a 3 categorias aleatórias
            $categories = Category::inRandomOrder()->limit(rand(1, 3))->pluck('id');
            $blog->categories()->attach($categories);
        });
    }
}
