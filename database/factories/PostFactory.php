<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $title = $this->faker->sentence(3);
    return [
      'title' => $title,
      'slug' => Str::slug($title),
      'content' => $this->faker->paragraph(),
      'category_id' => Category::InRandomOrder()->first()->id,
    ];
  }
}
