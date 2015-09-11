<?php

namespace Qumonto\UserSys\Listeners;

use Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Qumonto\UserSys\Events\UserRegistered;


class AccountVerificationEmail implements ShouldQueue
{
    protected $user;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $this->user = $event->user;

        if(is_null(config('usersys.email_verify_view'))){
            $view = 'usersys::verify';
        }
        else{
            $view = 'usersys.email_verify_view';
        }

        $appname = config('usersys.app_name');

        Mail::send($view, 
            ['verification_token' => $this->user->verification_token], 
            function($message) 
            {
                $message->to($this->user->email, $this->user->username)
                        ->subject("Welcome to $appname - Email verification");
            });
    }
}