<?php

namespace App\Policies;

use App\Enums\ModelEnum;
use App\Enums\PermissionEnum;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission(PermissionEnum::viewAny, ModelEnum::role);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $role): bool
    {
        if ($role->id == ModelEnum::role->value) {
            return false;
        }

        return $user->hasPermission(PermissionEnum::view, ModelEnum::role);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(PermissionEnum::create, ModelEnum::role);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $role): bool
    {
        if ($role->id == ModelEnum::role->value) {
            return false;
        }

        return $user->hasPermission(PermissionEnum::update, ModelEnum::role);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role): bool
    {
        if ($role->id == ModelEnum::role->value) {
            return false;
        }

        return $user->hasPermission(PermissionEnum::delete, ModelEnum::role);
    }
}
