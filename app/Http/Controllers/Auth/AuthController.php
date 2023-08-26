<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //

    // Show Login (View)

    public function showLogin(Request $request, $guard) {
        return response()->view('cms.auth.login', ['guard' => $guard]);
    }

    // Login


    public function login(Request $request) {
        $validator = Validator($request->all(), [
            'guard'       => 'required|string|in:broker,admin',
            'email'       => 'required|email',
            'password'    => 'required|string|min:1|max:20',
            'remember_me' => 'required|boolean',
        ], [
            'guard.in' => 'Url is not correct, check and try again'
        ]);

        if (!$validator->fails()) {
            $credentials = ['email' => $request->input('email'),'password' => $request->input('password')];
            if (Auth::guard($request->input('guard'))->attempt($credentials,$request->input('remember_me'))) {
                return response()->json([
                    'massage' => 'logged in successfully'
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'Error credentials, check and try again'
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }


    // Edit Password

    public function editPassword(Request $request)
    {
        return response()->view('cms.auth.edit-password');
    }

    public function updatePassword(Request $request)
    {
        $guard = auth('admin')->check() ? 'admin' : 'broker';
        $validator = validator($request->all(), [
            'password' => 'required|string|current_password:'. $guard,
            'new_password' => 'required|string|min:3|max:25|confirmed',
            'new_password_confirmation' => 'required|string|min:3|max:25',  // _confirmation الاسم الي في هادا السطر انا مقيد فيه لازم يكون نفس الي فوق بس عليه زيادة
        ]);

        if(!$validator->fails()) {
            $user = auth($guard)->user();
            $user->password = Hash::make($request->input('new_password'));
            $isSaved = $user->save();
            return response()->json([
                'message' => $isSaved ? 'Password change successfully' : 'Password change failed'
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }


    // Edit Profile


    public function editProfile(Request $request)
    {
        $user = auth($this->getGuardName())->user();
        return response()->view('cms.auth.edit-profile', ['user'=> $user]);
    }

    public function updateProfile(Request $request)
    {
        $guard = $this->getGuardName();
        $table = $guard == 'admin' ? 'admins' : 'brokers' ;
        $validator = Validator($request->all(), [
            'name'  => 'required|string|min:3|max:45',
            'email' => "required|string|email|unique:$table,email,".auth($guard)->id(),  // هيك انا بقله في اخر جزء ان تكرار الايميل مسموح فقط اذا كان ايميل الي بده يعدل نفس ايميل مسجل الدخول
        ]);

        if (!$validator->fails()) {
            $user = auth($guard)->user();
            $user->name  = $request->input("name");
            $user->email = $request->input("email");
            $isSaved = $user->save();
            return response()->json([
                'message' => $isSaved ? 'Profile update successfully' : 'Profile update failed'
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }

    }


    // Logout

    public function logout(Request $request)
    {
        // auth('admin')->logout();    // هادي نفس السطر الي تحته
        $guard = auth('admin')->check() ? 'admin' : 'broker';
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('auth.login-view', $guard);
    }

    // Get guard name

    private function getGuardName()
    {
        return auth('admin')->check() ? 'admin' : 'broker' ;
    }

}
