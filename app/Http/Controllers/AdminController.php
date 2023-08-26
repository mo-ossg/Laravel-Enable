<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $data = Admin::where('id', '!=', auth('admin')->id())->get();
        $data = Admin::all();
        return response()->view('cms.admins.index', ['admins'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles = Role::where('guard_name', '=', 'admin')->get();
        return response()->view('cms.admins.create', ['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(), [
            'role_id' => 'required|integer|exists:roles,id',
            'email' => 'required|string|email|unique:admins,email',
            'name' => 'required|string|min:3|max:45',
        ]);
        if (!$validator->fails()) {
            $role = Role::findById($request->input('role_id'), 'admin');
            $admin = new Admin();
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->password = Hash::make(123456);
            $isSaved = $admin->save();
            if ($isSaved) $admin->assignRole($role);
            return response()->json([
                'message' => $isSaved ? 'Created Successfully' : 'Create Failed'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                "message" => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
        $roles = Role::where('guard_name','=','admin')->get();
        $adminRole = $admin->roles()->first();
        return response()->view('cms.admins.edit', ['admin'=>$admin,'roles'=>$roles,'adminRole'=>$adminRole]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
        $validator = Validator($request->all(), [
            'role_id' => 'required|integer|exists:roles,id',
            'email' => 'required|string|email|unique:admins,email,'.$admin->id,
            'name' => 'required|string|min:3|max:45',
        ]);
        if (!$validator->fails()) {
            $role = Role::findById($request->input('role_id'), 'admin');
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $isSaved = $admin->save();
            if ($isSaved) $admin->syncRoles($role);
            return response()->json([
                'message' => $isSaved ? 'Created Successfully' : 'Create Failed'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                "message" => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
