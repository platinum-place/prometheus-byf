<?php

namespace App\Policies;

use App\Models\User;
use App\Enums\ModelEnum;
use App\Enums\PermissionEnum;
use App\Models\Supplier\Supplier;

class SupplierPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission(PermissionEnum::viewAny, ModelEnum::supplier);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Supplier $supplier): bool
    {
        return $user->hasPermission(PermissionEnum::view, ModelEnum::supplier);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(PermissionEnum::create, ModelEnum::supplier);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Supplier $supplier): bool
    {
        return $user->hasPermission(PermissionEnum::update, ModelEnum::supplier);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Supplier $supplier): bool
    {
        return $user->hasPermission(PermissionEnum::delete, ModelEnum::supplier);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Supplier $supplier): bool
    {
        return $user->hasPermission(PermissionEnum::restore, ModelEnum::supplier);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Supplier $supplier): bool
    {
        return $user->hasPermission(PermissionEnum::forceDelete, ModelEnum::supplier);
    }
}
