<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Court;
use Illuminate\Auth\Access\HandlesAuthorization;

class CourtPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the court can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list courts');
    }

    /**
     * Determine whether the court can view the model.
     */
    public function view(User $user, Court $model): bool
    {
        return $user->hasPermissionTo('view courts');
    }

    /**
     * Determine whether the court can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create courts');
    }

    /**
     * Determine whether the court can update the model.
     */
    public function update(User $user, Court $model): bool
    {
        return $user->hasPermissionTo('update courts');
    }

    /**
     * Determine whether the court can delete the model.
     */
    public function delete(User $user, Court $model): bool
    {
        return $user->hasPermissionTo('delete courts');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete courts');
    }

    /**
     * Determine whether the court can restore the model.
     */
    public function restore(User $user, Court $model): bool
    {
        return false;
    }

    /**
     * Determine whether the court can permanently delete the model.
     */
    public function forceDelete(User $user, Court $model): bool
    {
        return false;
    }
}
