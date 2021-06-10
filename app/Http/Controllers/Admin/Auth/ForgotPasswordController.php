<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    /**
     * Display the form to request a password reset link.
     */
    public function showLinkRequestForm()
    {
        return view('admin.auth.passwords.email');
    }

    /**
     * Send a reset link to the given user.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    /**
     * password broker for admin guard.
     */
    public function broker(){
        return Password::broker('admins');
    }

    /**
     * Get the guard to be used during authentication
     * after password reset.
     */
    public function guard(){
        return Auth::guard('admin');
    }
}