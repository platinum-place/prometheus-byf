<?php

namespace App\Policies;

use App\Enums\ModelEnum;
use App\Enums\PermissionEnum;
use App\Models\User;
use App\Models\Vehicle\Vehicle;

class VehiclePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission(PermissionEnum::viewAny, ModelEnum::vehicle);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Vehicle $vehicle): bool
    {
        return $user->hasPermission(PermissionEnum::view, ModelEnum::vehicle);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(PermissionEnum::create, ModelEnum::vehicle);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vehicle $vehicle): bool
    {
        return $user->hasPermission(PermissionEnum::update, ModelEnum::vehicle);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Vehicle $vehicle): bool
    {
        return $user->hasPermission(PermissionEnum::delete, ModelEnum::vehicle);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Vehicle $vehicle): bool
    {
        return $user->hasPermission(PermissionEnum::restore, ModelEnum::vehicle);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Vehicle $vehicle): bool
    {
        return $user->hasPermission(PermissionEnum::forceDelete, ModelEnum::vehicle);
    }
}
