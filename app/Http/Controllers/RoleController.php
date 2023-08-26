<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $data = Role::withCount('permissions')->get();
        return response()->view('cms.spatie.roles.index',['roles'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $guard = ['admin'=>'Admin', 'broker'=>'Broker'];
        return response()->view('cms.spatie.roles.create',$guard);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(), [
            'name'  => 'required|string|min:3|max:50',
            'guard' => 'required|string|in:admin,broker',
        ]);

        if(!$validator->fails()) {
            $role = new Role();
            $role->name = $request->input('name');
            $role->guard_name = $request->input('guard');
            $isSave = $role->save();
            return response()->json(['message'=>$isSave ? 'Created successfully' : 'Created failed'
            ], $isSave ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST );
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
        $permissions = Permission::where('guard_name', $role->guard_name)->get();
        $rolePermissions = $role->permissions;
        foreach($permissions as $permission) {
            $permission->setAttribute('assigned', false);
            foreach ($rolePermissions as $rolePermission) {
                if ($rolePermission->id == $permission->id) {
                    $permission->SetAttribute('assigned', true);
                }
            }
        }
        return view('cms.spatie.roles.role-permissions',['role' => $role, 'permissions' => $permissions]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
