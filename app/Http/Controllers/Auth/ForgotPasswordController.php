<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    private $message = '';
    private $success = '';
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        $email = $request->input('email');
        $user = User::where('email', $email)->where('is_suspend', 0)->first();
        if ($user) {
            $otp = rand(1000, 9999);
            $user->otp_expire_date =  Carbon::now()->modify('+3600 seconds');
            $user->otp =  $otp;
            $user->save();
            Mail::to($email)->send(new ResetPasswordMail($otp));
            $this->message = 'We have sent a password reset email';
            $this->success = true;
        } else {
            $this->message = "We can'nt find a user with this email address!";
        }

        return response()->json(['success' => $this->success, 'message' => $this->message]);
    }

    /**
     * This is used to verify otp
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function verifyOpt(Request $request)
    {
        $this->message = 'Please enter a valid otp!';
        $data = $request->all();
        if ($data['otp']) {
            $user = User::where('email', $data['email'])->where('otp', $data['otp'])->first();
            if ($user) {
                $this->message = 'Otp Expired';
                if ($user->otp_expire_date >= Carbon::now()) {
                    $this->message = 'Otp verified successfully';
                    $this->success = true;
                    $user->otp = null;
                    $user->otp_expire_date = null;
                    $user->save();
                }
            }
        }

        return response()->json(['success' => $this->success, 'message' => $this->message]);
    }
}
