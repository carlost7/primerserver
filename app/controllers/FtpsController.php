<?php

class FtpsController extends \BaseController {

    /**
     * Display a listing of ftps
     *
     * @return Response
     */
    public function index()
    {
        $ftps = Ftp::all();

        return View::make('ftps.index', compact('ftps'));
    }

    /**
     * Show the form for creating a new ftp
     *
     * @return Response
     */
    public function create()
    {
        return View::make('ftps.create');
    }

    /**
     * Store a newly created ftp in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make($data      = Input::all(), Ftp::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        Ftp::create($data);

        return Redirect::route('ftps.index');
    }

    /**
     * Display the specified ftp.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $ftp = Ftp::findOrFail($id);

        return View::make('ftps.show', compact('ftp'));
    }

    /**
     * Show the form for editing the specified ftp.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $ftp = Ftp::find($id);

        return View::make('ftps.edit', compact('ftp'));
    }

    /**
     * Update the specified ftp in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $ftp = Ftp::findOrFail($id);

        $validator = Validator::make($data      = Input::all(), Ftp::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $ftp->update($data);

        return Redirect::route('ftps.index');
    }

    /**
     * Remove the specified ftp from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Ftp::destroy($id);

        return Redirect::route('ftps.index');
    }

}
