<?php

return [

	'app_name'	=> 'UserSys',

    /*
    |--------------------------------------------------------------------------
    | Redirection path after failed login
    |--------------------------------------------------------------------------
    |
    | When a user attempts to login to the application and if the user
    | fails to authenticate then the user will be redirected to the
    | route provided below. Default is set to 'login' route.
    |
    */

	'redirect_after_fail' => '/login',


    /*
    |--------------------------------------------------------------------------
    | Redirection path after logout
    |--------------------------------------------------------------------------
    |
    | When the user tries to logout from the application, the user will be
    | redirected to the route provided below after a successful logout.
    | Default is set to '/login', can be set according to preference
    |
    */

	'redirect_after_logout' => '/login',


    /*
    |--------------------------------------------------------------------------
    | Redirection path after login
    |--------------------------------------------------------------------------
    |
    | After a successful login into the application, the user will be 
    | redirected to the route provided below. The default is set to
    | `\home` and can be changed according to the preference.
    |
    */

	'redirect_after_login' => '/home',



	'redirect_after_verification'	=>	"/login",


    /*
    |--------------------------------------------------------------------------
    | Post registration
    |--------------------------------------------------------------------------
    |
    | If the value is set to true, then after a successful registration, the
    | user will be redirected to the path set to `redirect_after_login` key. 
    | Else, user will be redirected to the path set to `redirect_after_logout`.
    |
    */

	'log_user_after_registration' => false,


    /*
    |--------------------------------------------------------------------------
    | Email verification
    |--------------------------------------------------------------------------
    |
    | If the value is set to true, then after a successful registration, the
    | user will have to verify the account by clicking a link sent via email. 
    | Else, user will be able to login without email verification process.
	|
    | Remember, you'll have to create `active` column in your user's table
    | if you are not using the migrations provided by 'usersys' package.
    |
    */

	'email_verification' => true,


	/*
    |--------------------------------------------------------------------------
    | Login email database column or field.
    |--------------------------------------------------------------------------
    |
    | The name field of login email at login form and the corresponding database 
    | column must be the same. For example, if you are using 'email_id' as the 
    | name for login field at login form, then you must also use 'email_id'  
    | as the name for the corresponding database column.
    |
    */

	'username_column_and_field' => 'email',


	/*
    |--------------------------------------------------------------------------
    | Password database column or field.
    |--------------------------------------------------------------------------
    |
    | If you are using a column name other than 'password' to store your 
    | password then you may specify it here. For example, if you are 
    | using 'pass' as the name for the database column in which you
    | store password, then you must also use 'pass' as the name 
    | for password field at login form and specify it below.
    |
    */

	'password_column_and_field'	=> 'password',


	/*
    |--------------------------------------------------------------------------
    | Login view
    |--------------------------------------------------------------------------
    |
    | Specify the view you want to use for login form. It will be overiding 
    | the default view of the package. If you want to load the default 
    | views for login page then set the field to 'null'.  
    |
    */

	'login_view'	=>	null,


	/*
    |--------------------------------------------------------------------------
    | Register view
    |--------------------------------------------------------------------------
    |
    | Specify the view you want to use for register form. It will be overiding 
    | the default view of the package. If you want to load the default 
    | views for register page then set the field to 'null'.  
    |
    */

	'register_view'	=>	null,


	/*
    |--------------------------------------------------------------------------
    | Email verification view
    |--------------------------------------------------------------------------
    |
    | Specify the view you want to use for sending verification emails. 
    | The new value will overide the default view. If you want to load  
    | the default views for login page then set the field to 'null'.  
    |
    */

	'email_verify_view'	=>	null,


	'forgot_password_view'	=> null,

	'reset_email_subject'	=> "Your Password Reset Link",

	'session_identifier'	=> "message",

	'email_verification_success'	=>	"Your account has been verified!",

];