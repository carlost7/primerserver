<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>{{trans('frontend.title.reminder_mail')}}</h2>

        <div>
            {{trans('frontend.instructions.reminder_mail')}}
            {{ HTML::linkAction('RemindersController@getReset','Cambiar Password',array($token))}}                
        </div>
    </body>
</html>
