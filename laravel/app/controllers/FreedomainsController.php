<?php

class FreedomainsController extends \BaseController {

	/**
	 * Display a listing of freedomains
	 *
	 * @return Response
	 */
	public function index()
	{
		$freedomains = Freedomain::all();

		return View::make('freedomains.index', compact('freedomains'));
	}

	/**
	 * Show the form for creating a new freedomain
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('freedomains.create');
	}

	/**
	 * Store a newly created freedomain in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Freedomain::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Freedomain::create($data);

		return Redirect::route('freedomains.index');
	}

	/**
	 * Display the specified freedomain.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$freedomain = Freedomain::findOrFail($id);

		return View::make('freedomains.show', compact('freedomain'));
	}

	/**
	 * Show the form for editing the specified freedomain.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$freedomain = Freedomain::find($id);

		return View::make('freedomains.edit', compact('freedomain'));
	}

	/**
	 * Update the specified freedomain in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$freedomain = Freedomain::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Freedomain::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$freedomain->update($data);

		return Redirect::route('freedomains.index');
	}

	/**
	 * Remove the specified freedomain from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Freedomain::destroy($id);

		return Redirect::route('freedomains.index');
	}

}
