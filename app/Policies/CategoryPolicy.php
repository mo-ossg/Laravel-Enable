<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;


class CategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($userId)
    {
        //
        $guard = auth('admin')->check() ? 'admin' : 'broker';
        return auth($guard)->check() && auth($guard)->user()->hasPermissionTo('Read-Categories')
        ? Response::allow()
        : Response::deny('Access Denied, No Permission');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($userId, Category $category)
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
        return auth($guard)->check() && auth($guard)->user()->hasPermissionTo('Create-Category')
        ? Response::allow()
        : Response::deny();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($userId, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($userId, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($userId, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($userId, Category $category)
    {
        //
    }
}
