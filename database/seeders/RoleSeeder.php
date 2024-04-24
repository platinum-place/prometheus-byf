<?php

namespace Database\Seeders;

use App\Enums\ModelEnum;
use App\Enums\RoleEnum;
use App\Enums\PermissionEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
