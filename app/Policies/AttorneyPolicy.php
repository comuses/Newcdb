<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Attorney;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttorneyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the attorney can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list attorneys');
    }

    /**
     * Determine whether the attorney can view the model.
     */
    public function view(User $user, Attorney $model): bool
    {
        return $user->hasPermissionTo('view attorneys');
    }

    /**
     * Determine whether the attorney can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create attorneys');
    }

    /**
     * Determine whether the attorney can update the model.
     */
    public function update(User $user, Attorney $model): bool
    {
        return $user->hasPermissionTo('update attorneys');
    }

    /**
     * Determine whether the attorney can delete the model.
     */
    public function delete(User $user, Attorney $model): bool
    {
        return $user->hasPermissionTo('delete attorneys');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete attorneys');
    }

    /**
     * Determine whether the attorney can restore the model.
     */
    public function restore(User $user, Attorney $model): bool
    {
        return false;
    }

    /**
     * Determine whether the attorney can permanently delete the model.
     */
    public function forceDelete(User $user, Attorney $model): bool
    {
        return false;
    }
}
