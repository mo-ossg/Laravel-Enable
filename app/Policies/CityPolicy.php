<?php

namespace App\Policies;

use App\Models\City;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CityPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($userId)
    {
        //
        $guard = auth('admin')->check() ? 'admin' : 'broker';
        return auth($guard)->check() && auth($guard)->user()->hasPermissionTo('Read-Cities')
        ? Response::allow()
        : Response::deny('Access Denied, No Permission');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, City $city)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($userId)
    {
        //
        $guard = auth('admin')->check() ? 'admin' : 'broker';
        return auth($guard)->check() && auth($guard)->user()->hasPermissionTo('Create-City')
        ? Response::allow()
        : Response::deny('Access Denied, No Permission');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, City $city)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, City $city)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, City $city)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, City $city)
    {
        //
    }
}
