<?php

class DatabasesController extends \BaseController {

	/**
	 * Display a listing of databases
	 *
	 * @return Response
	 */
	public function index()
	{
		$databases = Database::all();

		return View::make('databases.index', compact('databases'));
	}

	/**
	 * Show the form for creating a new databasis
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('databases.create');
	}

	/**
	 * Store a newly created databasis in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Databases::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Database::create($data);

		return Redirect::route('databases.index');
	}

	/**
	 * Display the specified databasis.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$databasis = Database::findOrFail($id);

		return View::make('databases.show', compact('databasis'));
	}

	/**
	 * Show the form for editing the specified databasis.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$databasis = Database::find($id);

		return View::make('databases.edit', compact('databasis'));
	}

	/**
	 * Update the specified databasis in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$databasis = Database::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Database::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$databasis->update($data);

		return Redirect::route('databases.index');
	}

	/**
	 * Remove the specified databasis from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Database::destroy($id);

		return Redirect::route('databases.index');
	}

}
