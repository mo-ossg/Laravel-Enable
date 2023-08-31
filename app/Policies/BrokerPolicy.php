<?php

namespace App\Policies;

use App\Models\Broker;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BrokerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($userId)
    {
        //
        $guard = auth('admin')->check() ? 'admin' : 'broker';
        return auth($guard)->check() && auth($guard)->user()->hasPermissionTo('Read-Brokers')
        ? Response::allow()
        : Response::deny('Access Denied, No Permission');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Broker $broker): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($userId)
    {
        //
        return auth('admin')->check() && auth('admin')->user()->hasPermissionTo('Create-Broker')
        ? Response::allow()
        : Response::deny('Access Denied, No Permission');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Broker $broker): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Broker $broker): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Broker $broker): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Broker $broker): bool
    {
        //
    }
}
