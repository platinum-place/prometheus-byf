<?php

namespace App\Policies;

use App\Models\User;
use App\Enums\ModelEnum;
use App\Enums\PermissionEnum;
use App\Models\Vehicle\VehicleModel;

class VehicleModelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission(PermissionEnum::viewAny, ModelEnum::vehicleModel);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, VehicleModel $vehicleModel): bool
    {
        return $user->hasPermission(PermissionEnum::view, ModelEnum::vehicleModel);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(PermissionEnum::create, ModelEnum::vehicleModel);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, VehicleModel $vehicleModel): bool
    {
        return $user->hasPermission(PermissionEnum::update, ModelEnum::vehicleModel);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, VehicleModel $vehicleModel): bool
    {
        return $user->hasPermission(PermissionEnum::delete, ModelEnum::vehicleModel);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, VehicleModel $vehicleModel): bool
    {
        return $user->hasPermission(PermissionEnum::restore, ModelEnum::vehicleModel);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, VehicleModel $vehicleModel): bool
    {
        return $user->hasPermission(PermissionEnum::forceDelete, ModelEnum::vehicleModel);
    }
}
