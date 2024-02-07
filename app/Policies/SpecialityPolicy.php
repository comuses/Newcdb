<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Speciality;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpecialityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the speciality can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list specialities');
    }

    /**
     * Determine whether the speciality can view the model.
     */
    public function view(User $user, Speciality $model): bool
    {
        return $user->hasPermissionTo('view specialities');
    }

    /**
     * Determine whether the speciality can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create specialities');
    }

    /**
     * Determine whether the speciality can update the model.
     */
    public function update(User $user, Speciality $model): bool
    {
        return $user->hasPermissionTo('update specialities');
    }

    /**
     * Determine whether the speciality can delete the model.
     */
    public function delete(User $user, Speciality $model): bool
    {
        return $user->hasPermissionTo('delete specialities');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete specialities');
    }

    /**
     * Determine whether the speciality can restore the model.
     */
    public function restore(User $user, Speciality $model): bool
    {
        return false;
    }

    /**
     * Determine whether the speciality can permanently delete the model.
     */
    public function forceDelete(User $user, Speciality $model): bool
    {
        return false;
    }
}
