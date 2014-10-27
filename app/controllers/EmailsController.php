<?php

class EmailsController extends \BaseController {

	/**
	 * Display a listing of emails
	 *
	 * @return Response
	 */
	public function index()
	{
		$emails = Email::all();

		return View::make('emails.index', compact('emails'));
	}

	/**
	 * Show the form for creating a new email
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('emails.create');
	}

	/**
	 * Store a newly created email in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Email::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Email::create($data);

		return Redirect::route('emails.index');
	}

	/**
	 * Display the specified email.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$email = Email::findOrFail($id);

		return View::make('emails.show', compact('email'));
	}

	/**
	 * Show the form for editing the specified email.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$email = Email::find($id);

		return View::make('emails.edit', compact('email'));
	}

	/**
	 * Update the specified email in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$email = Email::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Email::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$email->update($data);

		return Redirect::route('emails.index');
	}

	/**
	 * Remove the specified email from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Email::destroy($id);

		return Redirect::route('emails.index');
	}

}
