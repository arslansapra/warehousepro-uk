<?php

namespace Database\Factories;

use App\Models\WarehouseLocation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WarehouseLocationFactory extends Factory
{
    protected $model = WarehouseLocation::class;

    public function definition(): array
    {
        $zone = $this->faker->randomLetter();
        $rack = $this->faker->numberBetween(1, 50);
        $shelf = $this->faker->numberBetween(1, 10);

        return [
            'zone' => $this->faker->randomLetter(),
            'rack' => $this->faker->numberBetween(1, 50),
            'shelf' => $this->faker->numberBetween(1, 10),
            'code' => function (array $attributes) {
                return strtoupper($attributes['zone'].'-'.$attributes['rack'].'-'.$attributes['shelf']);
            },
        ];
    }
}