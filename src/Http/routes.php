<?php

Route::get('/', function()
{
	return "UserSys Package!";
});

// Authentication routes...
Route::get('login', 'Qumonto\UserSys\Http\Controllers\AuthController@getLogin');
Route::post('login', 'Qumonto\UserSys\Http\Controllers\AuthController@postLogin');
Route::get('logout', 'Qumonto\UserSys\Http\Controllers\AuthController@getLogout');

// Registration routes...
Route::get('register', 'Qumonto\UserSys\Http\Controllers\AuthController@getRegister');
Route::post('register', 'Qumonto\UserSys\Http\Controllers\AuthController@postRegister');

// Email verification...
Route::get('verify/{verify_token}', 'Qumonto\UserSys\Http\Controllers\AuthController@getVerify');

// Password reset link request routes...
Route::get('reset/email', 'Qumonto\UserSys\Http\Controllers\PasswordController@getEmail');
Route::post('reset/email', 'Qumonto\UserSys\Http\Controllers\PasswordController@postEmail');

// Password reset link request routes...
Route::get('reset/email', 'App\Http\Controllers\Auth\PasswordController@getEmail');
Route::post('reset/email', 'App\Http\Controllers\Auth\PasswordController@postEmail');
// Password reset routes...
Route::get('reset/{token}', 'App\Http\Controllers\Auth\PasswordController@getReset');
Route::post('reset', 'App\Http\Controllers\Auth\PasswordController@postReset');