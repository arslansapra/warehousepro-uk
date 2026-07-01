<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = $this->faker->word();

        return [
            'name' => $this->faker->word(),
            'slug' => fn (array $attributes) =>
                \Illuminate\Support\Str::slug($attributes['name']),
            'description' => $this->faker->sentence(),
        ];
    }
}