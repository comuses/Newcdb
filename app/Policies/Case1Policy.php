<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Case1;
use Illuminate\Auth\Access\HandlesAuthorization;

class Case1Policy
{
    use HandlesAuthorization;

    /**
     * Determine whether the case1 can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list case1s');
    }

    /**
     * Determine whether the case1 can view the model.
     */
    public function view(User $user, Case1 $model): bool
    {
        return $user->hasPermissionTo('view case1s');
    }

    /**
     * Determine whether the case1 can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create case1s');
    }

    /**
     * Determine whether the case1 can update the model.
     */
    public function update(User $user, Case1 $model): bool
    {
        return $user->hasPermissionTo('update case1s');
    }

    /**
     * Determine whether the case1 can delete the model.
     */
    public function delete(User $user, Case1 $model): bool
    {
        return $user->hasPermissionTo('delete case1s');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete case1s');
    }

    /**
     * Determine whether the case1 can restore the model.
     */
    public function restore(User $user, Case1 $model): bool
    {
        return false;
    }

    /**
     * Determine whether the case1 can permanently delete the model.
     */
    public function forceDelete(User $user, Case1 $model): bool
    {
        return false;
    }
}
