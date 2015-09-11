<?php

namespace Qumonto\UserSys\Http\Controllers;

use Password;
use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use Qumonto\UserSys\AuthenticationTrait;

class PasswordController extends Controller
{
	use AuthenticationTrait;
	
	/**
	 * Create a new PasswordController instance.			
	 * 
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show form to request password reset link.
	 * 
	 * @return Illuminate\Http\Response
	 */
	public function getEmail()
	{
		if(is_null(config('usersys.forgot_password_view'))){
			return view('usersys::forgot');
		}
		else{
			return view(config('usersys.forgot_password_view'));
		}
	}

	/**
	 * Can send a reset link to given user.
	 * 
	 * @param Illuminate\Http\Request $request
	 * @return Illuminate\Http\Response.
	 */
	public function postEmail(Request $request)
	{
		$this->validate($request, ['email' => 'required|email']);

		$response = Password::sendResetLink($request->only('email'), function (Message $message) {
            $message->subject($this->getEmailSubject());
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return redirect()->back()->with('status', trans($response));

            case Password::INVALID_USER:
                return redirect()->back()->withErrors(['email' => trans($response)]);
        }
	}

	/**
     * Display the password reset view for the given token.
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
	public function getReset($token = null)
	{
		# code...
	}

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function postReset(Request $request)
	{
		# code...
	}
}