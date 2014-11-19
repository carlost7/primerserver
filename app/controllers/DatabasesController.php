<?php

class DatabasesController extends \BaseController {

      /**
       * Display a listing of databases
       *
       * @return Response
       */
      public function index($user_id, $domain_id)
      {
            $user      = User::findOrFail($user_id);
            $domain    = Domain::findOrFail($domain_id);
            $databases = Database::where('domain_id', $domain_id)->paginate(10);

            return View::make('databases.index', compact('databases', 'user', 'domain'));
      }

      /**
       * Show the form for creating a new database
       *
       * @return Response
       */
      public function create($user_id, $domain_id)
      {
            $user   = User::findOrFail($user_id);
            $domain = Domain::findOrFail($domain_id);
            return View::make('databases.create', compact('user', 'domain'));
      }

      /**
       * Store a newly created database in storage.
       *
       * @return Response
       */
      public function store($user_id, $domain_id)
      {
            $user   = User::findOrFail($user_id);
            $domain = Domain::findOrFail($domain_id);

            if (Input::get('name_db') != "")
            {
                  $dbname = Input::get('name_db');
                  Input::merge(array('name_db' => $domain->server->nameserver . "_" . Input::get('name_db')));
            }
            if (Input::get('user') != "")
            {
                  $user_name = Input::get('user');
                  Input::merge(array('user' => $domain->server->nameserver . "_" . Input::get('user')));
            }

            $database = new Database;
            $database->domain()->associate($domain);
            if ($database->save())
            {
                  Session::flash('message', trans('frontend.messages.database.store.successful'));
                  Auth::login($user);
                  return Redirect::route('user.databases.index', array($user->id, $domain->id));
            }
            else
            {
                  if ($dbname)
                  {
                        Input::merge(array('name_db' => $dbname));
                  }
                  if ($user_name)
                  {
                        Input::merge(array('user' => $user_name));
                  }
                  return Redirect::back()->withErrors($database->errors())->withInput();
            }
      }

      /**
       * Display the specified database.
       *
       * @param  int  $id
       * @return Response
       */
      public function show($user_id, $domain_id, $id)
      {
            $user     = User::findOrFail($user_id);
            $domain   = Domain::findOrFail($domain_id);
            $database = Database::find($id);
            return View::make('databases.show', compact('user', 'domain', 'database'));
      }

      /**
       * Show the form for editing the specified database.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($user_id, $domain_id, $id)
      {
            $user     = User::findOrFail($user_id);
            $domain   = Domain::findOrFail($domain_id);
            $database = Database::find($id);

            return View::make('databases.edit', compact('database', "user", "domain"));
      }

      /**
       * Update the specified database in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($user_id, $domain_id, $id)
      {
            $database = Database::findOrFail($id);
            $user     = User::findOrFail($user_id);
            $domain   = Domain::findOrFail($domain_id);

            $database::$rules['password']              = (Input::get('password')) ? 'required|alpha_dash|min:8|confirmed' : '';
            $database::$rules['password_confirmation'] = (Input::get('password')) ? 'required' : '';

            if ($database->update())
            {
                  Session::flash('message', trans('frontend.messages.database.update.successful'));
                  return Redirect::route('user.databases.show', array($user->id, $domain->id, $database->id));
            }
            else
            {
                  return Redirect::back()->withInput()->withErrors($database->errors());
            }
      }

      /**
       * Remove the specified database from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($user_id, $domain_id, $id)
      {
            $user     = User::findOrFail($user_id);
            $domain   = Domain::findOrFail($domain_id);
            $database = Database::find($id);

            if ($database->delete())
            {
                  Session::flash('message', trans('frontend.messages.database.destroy.successful'));
            }
            return Redirect::route('user.databases.index', array($user->id, $domain->id));
      }

}
