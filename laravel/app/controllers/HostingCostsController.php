<?php

class HostingCostsController extends \BaseController {

	/**
	 * Display a listing of hostingcosts
	 *
	 * @return Response
	 */
	public function index()
	{
		$hostingcosts = Hostingcost::all();

		return View::make('admin.hostingcosts.index', compact('hostingcosts'));
	}

	/**
	 * Show the form for creating a new hostingcost
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('hostingcosts.create');
	}

	/**
	 * Store a newly created hostingcost in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Hostingcost::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Hostingcost::create($data);

		return Redirect::route('hostingcosts.index');
	}

	/**
	 * Display the specified hostingcost.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$hostingcost = Hostingcost::findOrFail($id);

		return View::make('hostingcosts.show', compact('hostingcost'));
	}

	/**
	 * Show the form for editing the specified hostingcost.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$hostingcost = Hostingcost::find($id);

		return View::make('hostingcosts.edit', compact('hostingcost'));
	}

	/**
	 * Update the specified hostingcost in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$hostingcost = Hostingcost::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Hostingcost::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$hostingcost->update($data);

		return Redirect::route('hostingcosts.index');
	}

	/**
	 * Remove the specified hostingcost from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Hostingcost::destroy($id);

		return Redirect::route('hostingcosts.index');
	}

}
