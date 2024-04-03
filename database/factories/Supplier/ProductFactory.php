<?php

namespace Database\Factories\Supplier;

use App\Models\Supplier\Supplier;
use App\Enums\Supplier\ProductTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->randomFloat(),
            'type' => $this->faker->randomElement(ProductTypeEnum::values()),
            'supplier_id' => Supplier::factory(),
        ];
    }
}
