<?php

class ServersController extends \BaseController {

      /**
       * Display a listing of servers
       *
       * @return Response
       */
      public function index()
      {
            $servers = Server::all();

            return View::make('admin.servers.index', compact('servers'));
      }

      /**
       * Show the form for creating a new server
       *
       * @return Response
       */
      public function create()
      {
            $plans = Plan::lists('plan_name', 'id');
            return View::make('admin.servers.create', compact('plans'));
      }

      /**
       * Store a newly created server in storage.
       *
       * @return Response
       */
      public function store()
      {
            $validator = Validator::make($data      = Input::all(), Server::$rules);

            if ($validator->fails())
            {
                  return Redirect::back()->withErrors($validator)->withInput();
            }

            Server::create($data);

            return Redirect::route('admin.servers.index');
      }

      /**
       * Display the specified server.
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            $server = Server::findOrFail($id);

            return View::make('admin.servers.show', compact('server'));
      }

      /**
       * Show the form for editing the specified server.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            $plans  = Plan::lists('plan_name', 'id');
            $server = Server::find($id);

            return View::make('admin.servers.edit', compact('server','plans'));
      }

      /**
       * Update the specified server in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            $server = Server::findOrFail($id);

            $validator = Validator::make($data      = Input::all(), Server::$rules);

            if ($validator->fails())
            {
                  return Redirect::back()->withErrors($validator)->withInput();
            }

            $server->update($data);

            return Redirect::route('admin.servers.index');
      }

      /**
       * Remove the specified server from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            Server::destroy($id);

            return Redirect::route('admin.servers.index');
      }

}
