<?php

class DominiosController extends \BaseController {

	/**
	 * Display a listing of dominios
	 *
	 * @return Response
	 */
	public function index()
	{
		$dominios = Dominio::all();

		return View::make('dominios.index', compact('dominios'));
	}

	/**
	 * Show the form for creating a new dominio
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('dominios.create');
	}

	/**
	 * Store a newly created dominio in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Dominio::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Dominio::create($data);

		return Redirect::route('dominios.index');
	}

	/**
	 * Display the specified dominio.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$dominio = Dominio::findOrFail($id);

		return View::make('dominios.show', compact('dominio'));
	}

	/**
	 * Show the form for editing the specified dominio.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$dominio = Dominio::find($id);

		return View::make('dominios.edit', compact('dominio'));
	}

	/**
	 * Update the specified dominio in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$dominio = Dominio::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Dominio::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$dominio->update($data);

		return Redirect::route('dominios.index');
	}

	/**
	 * Remove the specified dominio from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Dominio::destroy($id);

		return Redirect::route('dominios.index');
	}

}
