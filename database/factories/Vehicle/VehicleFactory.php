<?php

namespace Database\Factories\Vehicle;

use App\Enums\Vehicle\VehicleTypeEnum;
use App\Models\Vehicle\VehicleMake;
use App\Models\Vehicle\VehicleModel;
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
            'color' => $this->faker->text(5),
            'identification' => $this->faker->text(10),
            'plate' => $this->faker->text(10),
            'year' => $this->faker->randomNumber(4),
            'chassis' => $this->faker->text(10),
            'type' => $this->faker->randomElement(VehicleTypeEnum::values()),
            'vehicle_model_id' => VehicleModel::factory(),
            'vehicle_make_id' => VehicleMake::factory(),
        ];
    }
}
