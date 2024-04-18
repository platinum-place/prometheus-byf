<?php

namespace Database\Factories\Invoice;

use App\Models\Supplier\Agent;
use App\Models\Vehicle\Vehicle;
use App\Models\Customer\Contact;
use App\Models\Supplier\Product;
use App\Models\Customer\Customer;
use App\Models\Supplier\Supplier;
use App\Enums\Invoice\SaleTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(SaleTypeEnum::values()),
            'supplier_id' => Supplier::factory(),
            'agent_id' => Agent::factory(),
            'product_id' => Product::factory(),
            'customer_id' => Customer::factory(),
            'contact_id' => Contact::factory(),
            'note' => $this->faker->text(),

            /**
             *
             */
            'vehicle_id' => Vehicle::factory(),
            'site_a' => $this->faker->text(),
            'site_b' => $this->faker->text(),
        ];
    }
}
