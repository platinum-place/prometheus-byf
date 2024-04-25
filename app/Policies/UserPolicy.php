<?php

namespace App\Policies;

use App\Models\User;
use App\Enums\RoleEnum;
use App\Enums\userEnum;
use App\Enums\ModelEnum;
use App\Enums\PermissionEnum;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission(PermissionEnum::viewAny, ModelEnum::user);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        if ($model->hasRole(RoleEnum::admin->value)) {
            return false;
        }
        return $user->hasPermission(PermissionEnum::view, ModelEnum::user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(PermissionEnum::create, ModelEnum::user);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        if ($model->hasRole(RoleEnum::admin->value)) {
            return false;
        }
        return $user->hasPermission(PermissionEnum::update, ModelEnum::user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        if ($model->hasRole(RoleEnum::admin->value)) {
            return false;
        }
        return $user->hasPermission(PermissionEnum::delete, ModelEnum::user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->hasPermission(PermissionEnum::restore, ModelEnum::user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->hasPermission(PermissionEnum::forceDelete, ModelEnum::user);
    }
}
