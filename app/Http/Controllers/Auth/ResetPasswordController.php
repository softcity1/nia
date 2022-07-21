<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    private $message = '';
    private $success = '';
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->message = 'Please enter your registered email';
            $data = $request->all();
            $user = User::where('email', $data['email'])->first();
            $title = 'reset a password';
            if (!empty($user)) {
                if ($data['password'] != $data['password_confirmation']) {
                    $this->message = 'Password confirmation does not match';
                } else {
                    $user->password = Hash::make($data['password']);
                    $user->is_reset_password = 1;
                    $user->save();
                    $this->message = 'Password reset successfully';
                    $this->success = true;
                }
            }

            $arr = [];
            $arr['title'] = loginUserName().' '.$title;
            $arr['status'] = $this->success == true ? 'Successful' : 'Unsuccessful';
            $arr['created_at'] = now();
            $arr['updated_at'] = now();
            activity($arr);

            return response()->json(['success' => $this->success, 'message' => $this->message]);
        }

        return view('auth.passwords.reset');
    }
}
