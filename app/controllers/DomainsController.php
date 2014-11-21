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
        $user    = User::findOrFail($user_id);
        $domains = $user->domains()->paginate(10);

        return View::make('domains.index', compact('domains', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /domains/create
     *
     * @return Response
     */
    public function create($user_id)
    {
        $user  = User::find($user_id);
        $plans = Plan::lists('plan_name', 'id');        
        return View::make('domains.create', compact('plans', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     * POST /domains
     *
     * @return Response
     */
    public function store($user_id)
    {

        //Obtenemos el plan deseado y los datos de los servidores
        $plan           = Plan::with('servers.domains')->find(Input::get('plan_id'));
        $user           = User::find($user_id);
        //creamos el dominio en la base de datos
        $domain         = new Domain;
        $domain->active = false;
        $domain->plan()->associate($plan);
        $domain->server()->associate(getLeastBussyServer($plan));
        $domain->user()->associate($user);
        
        if ($domain->save())
        {
            $domain->domainPass()->save(new DomainPassword);
            Session::flash('message', trans('frontend.messages.domain.store.successful'));
            return Redirect::route("user.show", $user->id);
        }

        return Redirect::back()->withErrors($domain->errors())->withInput();
    }

    /**
     * Display the specified resource.
     * GET /domains/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($user_id, $id)
    {
        $user   = User::findOrFail($user_id);
        $domain = Domain::find($id);
        if ($domain->user->id != $user->id)
        {
            Session::flash('error', trans('frontend.not_user_element'));
            return Redirect::back();
        }
        return View::make('domains.show', compact('user', 'domain'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /domains/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($user_id, $id)
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
    public function update($user_id, $id)
    {
        $domain         = Domain::find($id);
        $domain->active = true;
        $domain::$rules = array();
        if ($domain->save())
        {
            //Agregamos un ftp al servidor
            $ftp           = new Ftp;
            $ftp->username = explode('.', $domain->domain)[0];
            $ftp->hostname = $domain->server->domain;
            $ftp->password = Crypt::decrypt($domain->domainPass->password);
            $ftp->password_confirmation = Crypt::decrypt($domain->domainPass->password);
            $ftp->domain()->associate($domain);
            if ($ftp->save())
            {
                $domain->domainPass->delete();
                Session::flash('message', trans('frontend.messages.domain.store.successful'));
                return Redirect::route("user.domains.index", $user_id);
            }else{
                Session::flash('error', trans('frontend.messages.domain.store.error'));
                return Redirect::back()->withErrors($ftp->errors());
            }
        }
        return Redirect::back()->withErrors($domain->errors());
        
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /domains/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($user_id, $id)
    {
        $user   = User::findOrFail($user_id);
        $domain = Domain::find($id);

        //Eliminamos Los datos del FTP
        foreach ($domain->ftps as $ftp) {
            $ftp->delete();
        }

        //Eliminamos las bases de datos
        foreach ($domain->databases as $database) {
            $database->delete();
        }

        //Eliminamos los correos electronicos de la base de datos
        foreach ($domain->emails as $email) {
            $email->delete();
        }


        if ($domain->delete())
        {
            Session::flash('message', trans('frontend.messages.domain.destroy.successful'));
        }
        else
        {
            Session::flash('message', trans('frontend.messages.domain.destroy.error'));
        }

        return Redirect::route("user.domains.index", $user->id);
    }

}
