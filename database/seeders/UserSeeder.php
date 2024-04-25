<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Warlyn',
            'email' => 'warlyn@prometheus.com',
        ]);
        $user->assignRole(RoleEnum::admin->value);
    }
}
