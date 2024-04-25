<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles
        foreach (RoleEnum::cases() as $role) {
            Role::updateOrCreate([
                'id' => $role->value,
            ], [
                'id' => $role->value,
                'name' => $role->name,
            ]);
        }
    }
}
