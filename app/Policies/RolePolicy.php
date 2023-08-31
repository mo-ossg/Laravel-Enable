<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;


class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($userId)
    {
        //
        // $guard = auth('admin')->check() ? 'admin' : 'broker';
        return auth('admin')->check() && auth('admin')->user()->hasPermissionTo('Read-Roles')
        ? Response::allow()
        : Response::deny('Access Denied, No Permission');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($userId)
    {
        //
        return auth('admin')->check() && auth('admin')->user()->hasPermissionTo('Create-Role')
        ? Response::allow()
        : Response::deny('Access Denied, No Permission');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Role $role)
    {
        //
    }
}
