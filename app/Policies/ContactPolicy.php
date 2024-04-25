<?php

namespace App\Policies;

use App\Models\User;
use App\Enums\ModelEnum;
use App\Enums\PermissionEnum;
use App\Models\Customer\Contact;

class ContactPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission(PermissionEnum::viewAny, ModelEnum::contact);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Contact $contact): bool
    {
        return $user->hasPermission(PermissionEnum::view, ModelEnum::contact);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(PermissionEnum::create, ModelEnum::contact);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Contact $contact): bool
    {
        return $user->hasPermission(PermissionEnum::update, ModelEnum::contact);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Contact $contact): bool
    {
        return $user->hasPermission(PermissionEnum::delete, ModelEnum::contact);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Contact $contact): bool
    {
        return $user->hasPermission(PermissionEnum::restore, ModelEnum::contact);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Contact $contact): bool
    {
        return $user->hasPermission(PermissionEnum::forceDelete, ModelEnum::contact);
    }
}
