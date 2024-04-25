<?php

namespace App\Policies;

use App\Enums\ModelEnum;
use App\Enums\PermissionEnum;
use App\Models\User;
use App\Models\Vehicle\VehicleMake;

class VehicleMakePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission(PermissionEnum::viewAny, ModelEnum::vehicleMake);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, VehicleMake $vehicleMake): bool
    {
        return $user->hasPermission(PermissionEnum::view, ModelEnum::vehicleMake);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(PermissionEnum::create, ModelEnum::vehicleMake);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, VehicleMake $vehicleMake): bool
    {
        return $user->hasPermission(PermissionEnum::update, ModelEnum::vehicleMake);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, VehicleMake $vehicleMake): bool
    {
        return $user->hasPermission(PermissionEnum::delete, ModelEnum::vehicleMake);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, VehicleMake $vehicleMake): bool
    {
        return $user->hasPermission(PermissionEnum::restore, ModelEnum::vehicleMake);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, VehicleMake $vehicleMake): bool
    {
        return $user->hasPermission(PermissionEnum::forceDelete, ModelEnum::vehicleMake);
    }
}
