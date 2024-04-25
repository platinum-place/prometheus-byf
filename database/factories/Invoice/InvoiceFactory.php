<?php

namespace Database\Factories\Invoice;

use App\Enums\Invoice\InvoiceStateEnum;
use App\Models\Customer\Contact;
use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'state' => $this->faker->randomElement(InvoiceStateEnum::values()),
            'customer_id' => Customer::factory(),
            'contact_id' => Contact::factory(),
            'note' => $this->faker->text(),
        ];
    }
}
