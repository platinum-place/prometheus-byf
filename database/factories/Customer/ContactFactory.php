<?php

namespace Database\Factories\Customer;

use App\Models\Customer\Contact;
use App\Enums\Status;
use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer\Contact>
 */
class ContactFactory extends Factory
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
            'customer_id' => Customer::factory(),
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
