<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>{{trans('frontend.reminder_mail.title')}}</h2>

        <div>
            {{trans('frontend.reminder_mail.instructions')}}
            {{ HTML::linkAction('RemindersController@getReset','Cambiar Password',array($token))}}                
        </div>
    </body>
</html>
