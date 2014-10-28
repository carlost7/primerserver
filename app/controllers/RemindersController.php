<?php

class RemindersController extends Controller
{

      /**
       * Display the password reminder view.
       *
       * @return Response
       */
      public function getRemind()
      {
            return View::make('password.remind');
      }

      /**
       * Handle a POST request to remind a user of their password.
       *
       * @return Response
       */
      public function postRemind()
      {
            switch ($response = Password::remind(Input::only('email'), function($message)
            {
                  $message->subject(trans('frontend.reminder_mail.title'));
            }
            ))
            {
                  case Password::INVALID_USER:
                        return Redirect::back()->with('error', Lang::get($response));

                  case Password::REMINDER_SENT:
                        return Redirect::to("/")->with('message', Lang::get($response));
            }
      }

      /**
       * Display the password reset view for the given token.
       *
       * @param  string  $token
       * @return Response
       */
      public function getReset($token = null)
      {
            if (is_null($token))
                  App::abort(404);

            return View::make('password.reset')->with('token', $token);
      }

      /**
       * Handle a POST request to reset a user's password.
       *
       * @return Response
       */
      public function postReset()
      {
            $user = new User;
            $rules = array('password' => 'required|alpha_dash|min:8|confirmed',
                'password_confirmation' => 'required');
            if (!$user->validate($rules))
            {
                  return Redirect::back()->withErrors($user->errors());
            }

            $credentials = Input::only(
                            'email', 'password', 'password_confirmation', 'token'
            );

            $response = Password::reset($credentials, function($user, $password)
                    {
                          $user->updateUniques();
                    });

            switch ($response)
            {
                  case Password::INVALID_PASSWORD:
                  case Password::INVALID_TOKEN:
                  case Password::INVALID_USER:
                        return Redirect::back()->with('error', Lang::get($response));

                  case Password::PASSWORD_RESET:
                        Session::flash('message', trans('frontend.reset_password.successful'));
                        return Redirect::to('/');
            }
      }

}
