<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Retain;
use Illuminate\Auth\Access\HandlesAuthorization;

class RetainPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the retain can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list retains');
    }

    /**
     * Determine whether the retain can view the model.
     */
    public function view(User $user, Retain $model): bool
    {
        return $user->hasPermissionTo('view retains');
    }

    /**
     * Determine whether the retain can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create retains');
    }

    /**
     * Determine whether the retain can update the model.
     */
    public function update(User $user, Retain $model): bool
    {
        return $user->hasPermissionTo('update retains');
    }

    /**
     * Determine whether the retain can delete the model.
     */
    public function delete(User $user, Retain $model): bool
    {
        return $user->hasPermissionTo('delete retains');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete retains');
    }

    /**
     * Determine whether the retain can restore the model.
     */
    public function restore(User $user, Retain $model): bool
    {
        return false;
    }

    /**
     * Determine whether the retain can permanently delete the model.
     */
    public function forceDelete(User $user, Retain $model): bool
    {
        return false;
    }
}
