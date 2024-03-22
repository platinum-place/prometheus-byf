<?php

namespace Database\Factories\Customer;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(Status::values()),
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'identification' => $this->faker->text(50),
        ];
    }
}
