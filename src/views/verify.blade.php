<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Verify Your Email Address</h2>

        <div>
            Thanks for creating an account with the {!! config('usersys.app_name'). !!}
            Please follow the link below to verify your email address
            {{ URL::to('verify/' . $verification_token) }}.<br/>

        </div>

    </body>
</html>