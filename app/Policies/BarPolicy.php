<?php

namespace App\Policies;

use App\Models\Bar;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BarPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the bar can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list bars');
    }

    /**
     * Determine whether the bar can view the model.
     */
    public function view(User $user, Bar $model): bool
    {
        return $user->hasPermissionTo('view bars');
    }

    /**
     * Determine whether the bar can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create bars');
    }

    /**
     * Determine whether the bar can update the model.
     */
    public function update(User $user, Bar $model): bool
    {
        return $user->hasPermissionTo('update bars');
    }

    /**
     * Determine whether the bar can delete the model.
     */
    public function delete(User $user, Bar $model): bool
    {
        return $user->hasPermissionTo('delete bars');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete bars');
    }

    /**
     * Determine whether the bar can restore the model.
     */
    public function restore(User $user, Bar $model): bool
    {
        return false;
    }

    /**
     * Determine whether the bar can permanently delete the model.
     */
    public function forceDelete(User $user, Bar $model): bool
    {
        return false;
    }
}
