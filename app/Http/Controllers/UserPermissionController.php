<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class UserPermissionController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $permissions = Permission::where('guard_name', '=' , 'user-api')->get();
        $user = User::findOrFail($id);
        $userPermissions = $user->permissions;

        foreach($permissions as $permission) {
            $permission->setAttribute('assigned', false);
            foreach($userPermissions as $userPermission) {
                if ($userPermission->id == $permission->id) {
                    $permission->setAttribute('assigned', true);
                }
            }
        }

        return response()->view('cms.users.user-permissions', [
            'user' => $user,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator($request->all(),[
            'permission_id' => 'required|integer|exists:permissions,id',
        ]);

        if(! $validator->fails()) {
            $permission = Permission::findOrFail($request->input('permission_id'));
            $user = User::findOrFail($id);
            $message = '';
            if($user->hasPermissionTo($permission)) {
                $user->revokePermissionTo($permission);
                $message = 'Permission revoke successfully';
            } else {
                $user->givePermissionTo($permission);
                $message = 'Permission assigned successfully';
            }
            return response()->json(['message' => $message], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
