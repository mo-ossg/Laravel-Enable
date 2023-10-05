<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Broker;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthController extends Controller
{
    //
    // الطريقة 1 لتسجيل الدخول ->    الدخول من اكثر من جهاز في نفس الوقت

    // public function login(Request $request) {
    //     $validator = Validator($request->all(), [
    //         'email' => 'required|email|exists:users,email',
    //         'password' => 'required|string|min:3',
    //     ]);

    //     if (!$validator->fails()) {
    //         $user = User::where('email', '=', $request->input('email'))->first();
    //         if (Hash::check($request->input('password'), $user->password)) {
    //             $token = $user->createToken('User-API');
    //             $user->setAttribute('token', $token->accessToken);
    //             return response()->json([
    //                 'status' => true,
    //                 'message' => 'Logged in successfully',
    //                 'object' => $user,
    //             ]);
    //         } else {
    //         return response()->json([
    //             'message' => 'Error'
    //         ], Response::HTTP_BAD_REQUEST);
    //         }
    //     } else {
    //         return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
    //     }
    // }


    // الطريقة 1 لتسجيل الدخول -> ممنوع الدخول من اكثر من جهاز في نفس الوقت

    // public function login(Request $request) {
    //     $validator = Validator($request->all(), [
    //         'email' => 'required|email|exists:users,email',
    //         'password' => 'required|string|min:3',
    //     ]);

    //     if (!$validator->fails()) {
    //         $user = User::where('email', '=', $request->input('email'))->first();
    //         if (Hash::check($request->input('password'), $user->password)) {
    //             if (! $this->checkActiveSession($user->id)) {
    //                 $token = $user->createToken('User-API');
    //                 $user->setAttribute('token', $token->accessToken);
    //                 return response()->json([
    //                     'status' => true,
    //                     'message' => 'Logged in successfully',
    //                     'object' => $user,
    //                 ]);
    //             } else {
    //                 return response()->json(['message' => 'Multi access error'], Response::HTTP_FORBIDDEN);
    //             }
    //         } else {
    //         return response()->json([
    //             'message' => 'Error'
    //         ], Response::HTTP_BAD_REQUEST);
    //         }
    //     } else {
    //         return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
    //     }
    // }


        // الطريقة 2 لتسجيل الدخول -> بمجرد الدخول يلغي كل الجلسات السابقة

    //     public function login(Request $request) {
    //     $validator = Validator($request->all(), [
    //         'email' => 'required|email|exists:users,email',
    //         'password' => 'required|string|min:3',
    //     ]);

    //     if (!$validator->fails()) {
    //         $user = User::where('email', '=', $request->input('email'))->first();
    //         if (Hash::check($request->input('password'), $user->password)) {
    //             $this->endPreviousSessions($user->id);
    //             $token = $user->createToken('User-API');
    //             $user->setAttribute('token', $token->accessToken);
    //             return response()->json([
    //                 'status' => true,
    //                 'message' => 'Logged in successfully',
    //                 'object' => $user,
    //             ]);
    //         } else {
    //         return response()->json([
    //             'message' => 'Error'
    //         ], Response::HTTP_BAD_REQUEST);
    //         }
    //     } else {
    //         return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
    //     }
    // }


        // passport لتسجيل الدخول -> باستخدام

    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:brokers,email',
            'password' => 'required|string|min:3',
        ]);

        if (!$validator->fails()) {

            try {
                $response = Http::asForm()->post('http://127.0.0.1:8001/oauth/token', [
                    'grant_type'    => 'password',
                    'client_id'     => '3',
                    'client_secret' => '19JcGfT5imYETZcyFKiEBupSs6IeFGNprwKnjU4m',
                    'username'      => $request->input('email'),
                    'password'      => $request->input('password'),
                    'scope'         => '*',
                ]);

                $user = Broker::where('email', '=', $request->input('email'))->first();
                $decodedResponse = json_decode($response);
                $user->setAttribute('token', $response->json()['access_token']);
                $user->setAttribute('token_type',$response->json()['token_type']);

                return response()->json([
                    'status' => true,
                    'message' => 'Logged in successfully',
                    'object' => $user,
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'status'  => false,
                    'message' => $decodedResponse->message,
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function userLogin(Request $request)
    {
        $validator = Validator($request->all(), [
            'mobile' => 'required|numeric|digits:8',
            'password' => 'required|string|min:3',
        ]);

        if (!$validator->fails()) {
            try {
                $response = Http::asForm()->post('http://127.0.0.1:8001/oauth/token', [
                    'grant_type'    => 'password',
                    'client_id'     => '2',
                    'client_secret' => 'UFR2yHyi42m6C4ELLgnEUVIIzGqVQoIqP2NhVUZw',
                    'username'      => $request->input('mobile'),
                    'password'      => $request->input('password'),
                    'scope'         => '*',
                ]);

                $user = User::where('mobile', '=', $request->input('mobile'))->first();

                $user->setAttribute('token', $response->json()['access_token']);
                $user->setAttribute('token_type',$response->json()['token_type']);

                return response()->json([
                    'status' => true,
                    'message' => 'Logged in successfully',
                    'object' => $user,
                ]);
            } catch (\Throwable $th) {
                return response()->json($response->json(), Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }


    // تسجيل
    public function register(Request $request)
    {
        $validator = Validator($request->all(),[
            'name' => 'required|string|min:3|max:45',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|numeric|unique:users,mobile|digits:8',
            'password' => 'required|string|min:3',
        ]);
        if (!$validator->fails()) {
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->mobile = $request->input('mobile');
            $user->password = Hash::make($request->input('password'));
            $isSaved = $user->save();
            return response()->json(['message' => $isSaved ? 'Create successfully' : 'Create Failed'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
            ['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function forgetPassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if (! $validator->fails()) {
            $user = User::where('email', '=', $request->input('email'))->first();
            $authCode = random_int(1000,9999); // انتاج رقم عشوائي من 4 خانات
            $user->auth_code = Hash::make($authCode);
            $isSaved = $user->save();
            return response()->json(
                [
                    'status' => $isSaved,
                    'message' => $isSaved ? 'Reset code sent successfully' : 'Failed to successfully reset code!',
                    'code' => $authCode,
                ],
            $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()]);
        }
    }


    public function resetPassword(Request $request)
    {
        $validator = validator($request->all(), [
            'email' => 'required|email|exists:users,email',
            'auth_code' => 'required|numeric|digits:4',
            'password' => 'required|string|min:3|max:15|confirmed'
        ]);

        if (! $validator->fails()) {
            $user = User::where('email', '=', $request->input('email'))->first();
            if (! is_null($user->auth_code)) {
                if (Hash::check($request->input('auth_code'),$user->auth_code)) {
                    $user->password = $request->input('password');
                    $user->auth_code = null;
                    $isSaved = $user->save();
                    return response()->json(
                        [
                            'status' => $isSaved,
                            'message' => $isSaved ? 'Reset password success' : 'Reset password failed',
                        ],
                    $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Auth code error',
                    ], Response::HTTP_BAD_REQUEST);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'No password reset code',
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }


        // جزء من الطريقة 1 لتسجيل الدخول -> ممنوع الدخول من اكثر من جهاز في نفس الوقت
    private function checkActiveSession($userId)
    {
        return DB::table('oauth_access_tokens')      // بجيب الجدول من خلال اسمو model ولا بدي انشأ model بستخدمها لما ما يكون عندي
        -> where('user_id', '=', $userId)
        -> where('revoked', '=', false)
        -> exists();
    }

        // جزء من الطريقة 2 لتسجيل الدخول -> انهاء الجلسات السابقة
    private function endPreviousSessions($userId)
    {
        return DB::table('oauth_access_tokens')
        -> where('user_id', '=', $userId)
        -> where('name', '=', 'User-API')
        ->update([
            'revoked' => true
        ]);
    }

    public function logout(Request $request)
    {
        $guard = '';
        if ($request->user('user-api')) {
            $guard = 'user-api';
        } elseif ($request->user('broker-api')) {
            $guard = 'broker-api';
        }
        $token = $request->user($guard)->token();
        $revoked = $token->revoke();
        return response()->json([
            'status' => $revoked,
            'message' => $revoked ? 'Logged out successfully' : 'Logged out Failed',
        ]);
    }
}
