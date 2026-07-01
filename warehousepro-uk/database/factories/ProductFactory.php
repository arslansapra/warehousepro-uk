<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\WarehouseLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'sku' => strtoupper($this->faker->unique()->bothify('SKU-#####')),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'weight' => $this->faker->randomFloat(2, 0.1, 50),
            'quantity' => $this->faker->numberBetween(0, 100),

            'image' => null,

            // relationships (safe defaults for tests)
            'category_id' => Category::factory(),
            'warehouse_location_id' => WarehouseLocation::factory(),
        ];
    }
}