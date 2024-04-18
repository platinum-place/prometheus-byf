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
            'color' => $this->faker->text(),
            'identification' => $this->faker->text(),
            'plate' => $this->faker->text(),
            'year' => $this->faker->randomNumber(),
            'chassis' => $this->faker->text(),
            'type' => $this->faker->randomElement(VehicleTypeEnum::values()),
            'vehicle_model_id' => VehicleModel::factory(),
            'vehicle_make_id' => VehicleMake::factory(),
        ];
    }
}
