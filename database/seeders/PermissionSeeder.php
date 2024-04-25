<?php

namespace Database\Seeders;

use App\Enums\ModelEnum;
use App\Enums\PermissionEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        foreach (PermissionEnum::cases() as $permission) {
            foreach (ModelEnum::cases() as $model) {
                $name = "$permission->name-$model->name";
                Permission::updateOrCreate([
                    'name' => $name,
                ], [
                    'name' => $name,
                ]);
            }
        }
    }
}
