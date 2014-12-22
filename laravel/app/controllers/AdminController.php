<?php

class AdminController extends \BaseController {

      public function show($id)
      {
            if ($id != Auth::user()->id)
            {
                  Session::flash('error', trans('frontend.not_user_element'));
                  return Redirect::route('user.show', Auth::user()->id);
            }
            $user    = User::findOrFail($id);            
            return View::make('admin.show', compact('user'));
      }

      /**
       * Show the form for editing the specified user.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            $user = User::find($id);
            if ($user->id == Auth::user()->id)
            {
                  return View::make('admin.edit', compact('user'));
            }
            else
            {
                  Session::flash("error", trans('frontend.not_user_element'));
                  return Redirect::back();
            }
      }

      /**
       * Update the specified user in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            $user                                  = User::findOrFail($id);
            $user::$rules['password']              = (Input::get('password')) ? 'required|alpha_dash|min:8|confirmed' : '';
            $user::$rules['password_confirmation'] = (Input::get('password')) ? 'required' : '';
            if ($user->updateUniques())
            {
                  Session::flash('message', trans('frontend.messages.user.update.successful'));
                  return Redirect::route('admin.account.show', $user->id);
            }
            else
            {
                  return Redirect::back()->withInput()->withErrors($user->errors());
            }
      }

      /**
       * Remove the specified user from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            User::destroy($id);

            return Redirect::route('users.index');
      }

}
