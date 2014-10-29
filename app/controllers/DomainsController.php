<?php

class DomainsController extends \BaseController {

      /**
	 * Display a listing of the resource.
	 * GET /domains
	 *
	 * @return Response
	 */
	public function index($user_id)
	{
		$domains = Auth::user()->domains;
            
            return View::make('domains.index')->compact('domains');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /domains/create
	 *
	 * @return Response
	 */
	public function create($user_id)
	{
            
            
            return View::make('domains.create');            
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /domains
	 *
	 * @return Response
	 */
	public function store($user_id)
	{
		
	}

	/**
	 * Display the specified resource.
	 * GET /domains/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($user_id,$id)
	{
		
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /domains/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($user_id,$id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /domains/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($user_id,$id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /domains/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($user_id,$id)
	{
		//
	}

}