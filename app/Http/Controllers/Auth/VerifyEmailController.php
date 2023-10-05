<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyEmailController extends Controller
{
    //
    public function notice()
    {
        return view('cms.auth.verify-email');
    }

    public function send(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return response()->json(['message' => 'Verification link send!'], Response::HTTP_OK);
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/cms/admin');
    }
}
