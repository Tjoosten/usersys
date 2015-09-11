<?php

namespace Qumonto\UserSys\Http\Controllers;

use Event;
use App\User;
use App\Http\Requests\Request;
use App\Http\Controllers\Controller;

use Qumonto\UserSys\AuthenticationTrait;
use Qumonto\UserSys\Events\UserRegistered;
use Qumonto\UserSys\Http\Requests\UserLoginRequest;
use Qumonto\UserSys\Http\Requests\UserRegisterRequest;

class AuthController extends Controller
{
	use AuthenticationTrait;

	/**
	 * Create a new AuthController instance.
	 * 
	 * @return void
	 **/
	public function __construct()
	{
		$this->middleware('guest', ['except' => 'getLogout']);
	}

	/**
	 * Show login form.
	 * 
	 * @return Illuminate\Http\Response
	 **/
	public function getLogin()
	{
		if(is_null(config('usersys.login_view'))){
			return view('usersys::login');
		}
		else{
			return view(config('usersys.login_view'));
		}
	}

	/**
	 * Handle login request.
	 * 
	 * @param Illuminate\Http\Request $request
	 * @return Illuminate\Http\Response
	 **/
	public function postLogin(UserLoginRequest $request)
	{
		$credentials = $this->getCredentials($request);

		if (\Auth::attempt($credentials, $request->has('remember'))) {
            // clear the login attempts if throttle is set to true.
            
            // if email_verification is active
			if (config('usersys.email_verification')) {
	            // check if the account is activated
	            if (!\Auth::user()->verification_token) {
	            	return redirect()->intended(config('usersys.redirect_after_login'));
	            }
	            else {

	            	\Auth::logout();	// email not verified

	            	return redirect(config('usersys.redirect_after_fail'))
	            			->withInput($request->only($this->getUsernameColumnAndField(),'remember'))
	            			->withErrors([
	            				$this->getUsernameColumnAndField() => $this->getFailedLoginMessage('forActivation'),
	            			]);
	            }
			}
        }
        else{

	        // increment the throttle count.

	        return redirect(config('usersys.redirect_after_fail'))
			        ->withInput($request->only($this->getUsernameColumnAndField(), 'remember'))
			        ->withErrors([
			            $this->getUsernameColumnAndField() => $this->getFailedLoginMessage('forCredentials'),
			        ]);
        }

	    return redirect()->intended(config('usersys.redirect_after_login'));
	}

	/**
	 * Log the user out.
	 * 
	 * @return Illuminate\Http\Response
	 **/
	public function getLogout()
	{
		\Auth::logout();

		        session()->flash(config('usersys.session_identifier'), 'You have been logged out!');


        return redirect(config('usersys.redirect_after_logout'));
	}

	/**
	 * Show the registration form
	 * 
	 * @return Illuminate\Http\Response
	 **/
	public function getRegister()
	{
		if(is_null(config('usersys.register_view'))){
			return view('usersys::register');
		}
		else{
			return view(config('usersys.register_view'));
		}
	}

	/**
	 * Handle the registration request.
	 * 
	 * @param Illuminate\Http\Request $request
	 * @return Illuminate\Http\Response
	 **/
	public function postRegister(UserRegisterRequest $request)
	{
		$user = $this->createNewUser($request->all());

		if(config('usersys.log_user_after_registration')){
			\Auth::login($user);
			return redirect(config('usersys.redirect_after_login'));
		}
		else{
			return redirect(config('usersys.redirect_after_logout'));
		}
	}

	public function getVerify($verification_token)
    {
    	if( ! $this->tokenExists($verification_token))
        {
            throw new Exception("Invalid Confirmation Code", 1);
        }

        $user = User::where('verification_token', '=', $verification_token)->first();

        if(!$user) {
        	throw new Exception("Invalid Confirmation Code", 1);
            
        }

        $user->verification_token = null;
        $user->save();

        session()->flash(config('usersys.session_identifier'),config('usersys.email_verification_success'));

        return redirect(config('usersys.redirect_after_verification'));
    }
}