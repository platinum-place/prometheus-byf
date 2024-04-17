<?php

namespace Database\Factories\Vehicle;

use App\Models\Vehicle\VehicleMake;
use App\Models\Vehicle\VehicleModel;
use App\Enums\Vehicle\VehicleTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'color' => $this->faker->name,
            'identification' => $this->faker->name,
            'plate' => $this->faker->name,
            'year' => $this->faker->randomNumber(),
            'chassis' => $this->faker->name,
            'type' => $this->faker->randomElement(VehicleTypeEnum::values()),
            'vehicle_model_id' => VehicleModel::factory(),
            'vehicle_make_id' => VehicleMake::factory(),
        ];
    }
}
