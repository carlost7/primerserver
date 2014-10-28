<?php

class UserController extends \BaseController
{

      /**
       * Display the specified user.
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            $user = User::findOrFail($id);

            return View::make('users.show', compact('user'));
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
                  return View::make('users.edit', compact('user'));
            }else{
                  Session::flash("error",trans('frontend.not_user_element'));
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
            $user = User::findOrFail($id);

            $validator = Validator::make($data = Input::all(), User::$rules);

            if ($validator->fails())
            {
                  return Redirect::back()->withErrors($validator)->withInput();
            }

            
            
            $user->update($data);
            
            
            return Redirect::route('users.show',$user->id);
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
