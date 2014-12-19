<?php

class AdminUsersController extends \BaseController {

	/**
	 * Display a listing of adminusers
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::where('type','User')->paginate(50);

		return View::make('admin.users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new adminuser
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('adminusers.create');
	}

	/**
	 * Store a newly created adminuser in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Adminuser::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Adminuser::create($data);

		return Redirect::route('adminusers.index');
	}

	/**
	 * Display the specified adminuser.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$adminuser = Adminuser::findOrFail($id);

		return View::make('adminusers.show', compact('adminuser'));
	}

	/**
	 * Show the form for editing the specified adminuser.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$adminuser = Adminuser::find($id);

		return View::make('adminusers.edit', compact('adminuser'));
	}

	/**
	 * Update the specified adminuser in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$adminuser = Adminuser::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Adminuser::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$adminuser->update($data);

		return Redirect::route('adminusers.index');
	}

	/**
	 * Remove the specified adminuser from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Adminuser::destroy($id);

		return Redirect::route('adminusers.index');
	}

}
