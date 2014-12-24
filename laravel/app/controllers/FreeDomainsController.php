<?php

class FreeDomainsController extends \BaseController {

	/**
	 * Display a listing of freeDomains
	 *
	 * @return Response
	 */
	public function index()
	{
		$freeDomains = FreeDomain::paginate(10);

		return View::make('admin.freedomains.index', compact('freeDomains'));
	}

	/**
	 * Activate domain
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$freedomain = FreeDomain::findOrFail($id);

		$validator = Validator::make($data = Input::all(), FreeDomain::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$freedomain->update($data);

		return Redirect::route('admin.free_domains.index');
	}

	/**
	 * Remove the specified freedomain from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		FreeDomain::destroy($id);

		return Redirect::route('admin.free_domains.index');
	}

}
