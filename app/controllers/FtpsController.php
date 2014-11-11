<?php

class FtpsController extends \BaseController {

    /**
     * Display a listing of ftps
     *
     * @return Response
     */
    public function index($user_id, $domain_id)
    {
        $user   = User::findOrFail($user_id);
        $domain = Domain::findOrFail($domain_id);
        $ftps   = Ftp::where('domain_id', $domain_id)->paginate(10);

        return View::make('ftps.index', compact('ftps', 'user', 'domain'));
    }

    /**
     * Show the form for creating a new ftp
     *
     * @return Response
     */
    public function create($user_id, $domain_id)
    {
        $user   = User::findOrFail($user_id);
        $domain = Domain::findOrFail($domain_id);
        return View::make('ftps.create', compact('user', 'domain'));
    }

    /**
     * Store a newly created ftp in storage.
     *
     * @return Response
     */
    public function store($user_id, $domain_id)
    {
        $user   = User::findOrFail($user_id);
        $domain = Domain::findOrFail($domain_id);

        $ftp           = new Ftp;
        $ftp->hostname = $domain->server->domain;
        if (Input::get('homedir'))
        {
            $ftp->homedir  = 'public_html/' . $domain->domain."/".Input::get('homedir');
        }
        else
        {
            $ftp->homedir  = 'public_html/' . $domain->domain;
        }        
        $ftp->domain()->associate($domain);

        if ($ftp->save())
        {
            Session::flash('message', trans('frontend.messages.ftp.store.successful'));
            Auth::login($user);
            return Redirect::route('user.ftps.index', array($user->id, $domain->id));
        }
        else
        {
            return Redirect::back()->withErrors($ftp->errors())->withInput();
        }
    }

    /**
     * Display the specified ftp.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($user_id, $domain_id, $id)
    {
        $user   = User::findOrFail($user_id);
        $domain = Domain::findOrFail($domain_id);
        $ftp    = Ftp::find($id);
        return View::make('ftps.show', compact('user', 'domain', 'ftp'));
    }

    /**
     * Show the form for editing the specified ftp.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($user_id, $domain_id, $id)
    {
        $user   = User::findOrFail($user_id);
        $domain = Domain::findOrFail($domain_id);
        $ftp    = Ftp::find($id);

        return View::make('ftps.edit', compact('ftp', "user", "domain"));
    }

    /**
     * Update the specified ftp in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($user_id, $domain_id, $id)
    {
        $ftp    = Ftp::findOrFail($id);
        $user   = User::findOrFail($user_id);
        $domain = Domain::findOrFail($domain_id);

        $ftp::$rules['password']              = (Input::get('password')) ? 'required|alpha_dash|min:8|confirmed' : '';
        $ftp::$rules['password_confirmation'] = (Input::get('password')) ? 'required' : '';

        if ($ftp->update())
        {
            Session::flash('message', trans('frontend.messages.ftp.update.successful'));
            return Redirect::route('user.ftps.show', array($user->id, $domain->id, $ftp->id));
        }
        else
        {
            return Redirect::back()->withInput()->withErrors($ftp->errors());
        }
    }

    /**
     * Remove the specified ftp from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($user_id, $domain_id, $id)
    {
        $user   = User::findOrFail($user_id);
        $domain = Domain::findOrFail($domain_id);
        $ftp    = Ftp::findOrFail($id);
        //No se puede quedar el dominio sin ftps
        if (count($domain->ftps) > 1)
        {
            if ($ftp->delete())
            {
                Session::flash('message', trans('frontend.messages.ftp.destroy.successful'));
            }
            else
            {
                Session::flash('error', trans('frontend.messages.ftp.destroy.error'));
            }
        }
        else
        {
            Session::flash('error', trans('frontend.messages.ftp.empty.error'));
        }

        return Redirect::route('user.ftps.index', array($user->id, $domain->id));
    }

}
