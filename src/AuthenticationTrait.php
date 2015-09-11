<?php

namespace Qumonto\UserSys;

use App\User;

trait AuthenticationTrait
{
    /**
     * Creates a new user.
     * 
     * @param array $data
     * @return App\User $user
     */
    public function createNewUser($data)
    {
        $verification_token = str_random(50);

        $user = User::create([
            $this->getUsernameColumnAndField() => $data[$this->getUsernameColumnAndField()],
            $this->getPasswordColumnAndField() => bcrypt($data[$this->getPasswordColumnAndField()]),
            'verification_token' => $verification_token,
            ]);

        Event::fire(new UserRegistered($user));

        return $user;
    }

	 /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return $request->only($this->getUsernameColumnAndField(), 'password');
    }

    /**
     * Get the username corresponding database column and field.
     * 
     * @return string
     */
    protected function getUsernameColumnAndField()
    {
        return config('usersys.username_column_and_field');
    }

    /**
     * Get the password corresponding database column and field.
     * 
     * @return string
     */
    protected function getPasswordColumnAndField()
    {
        return config('usersys.password_column_and_field');
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage($spec)
    {
    	if ($spec == 'forCredentials') 
        {
        	return Lang::has('usersys.credentials')
                	? Lang::get('usersys.credentials')
                	: 'These credentials do not match our records.';
    	}
    	elseif ($spec == 'forActivation') 
        {
    		return Lang::has('usersys.inactive')
    				? Lang::get('usersys.inactive')
    				: 'Your email id is not verified.';
    	}
    }

    /**
     * Get the e-mail subject line to be used for the reset link email.
     *
     * @return string
     */
    protected function getEmailSubject()
    {
        return is_null(config('usersys.reset_email_subject')) 
                ? "Your email verification link." 
                : config('usersys.reset_email_subject');
    }

    protected function tokenExists($token)
    {
        return User::where('verification_token', $token)->first()->count() ? true : false;
    }
}