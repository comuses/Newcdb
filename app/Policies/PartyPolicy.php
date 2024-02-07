<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Party;
use Illuminate\Auth\Access\HandlesAuthorization;

class PartyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the party can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list parties');
    }

    /**
     * Determine whether the party can view the model.
     */
    public function view(User $user, Party $model): bool
    {
        return $user->hasPermissionTo('view parties');
    }

    /**
     * Determine whether the party can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create parties');
    }

    /**
     * Determine whether the party can update the model.
     */
    public function update(User $user, Party $model): bool
    {
        return $user->hasPermissionTo('update parties');
    }

    /**
     * Determine whether the party can delete the model.
     */
    public function delete(User $user, Party $model): bool
    {
        return $user->hasPermissionTo('delete parties');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete parties');
    }

    /**
     * Determine whether the party can restore the model.
     */
    public function restore(User $user, Party $model): bool
    {
        return false;
    }

    /**
     * Determine whether the party can permanently delete the model.
     */
    public function forceDelete(User $user, Party $model): bool
    {
        return false;
    }
}
