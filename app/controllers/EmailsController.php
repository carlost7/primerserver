<?php

class EmailsController extends \BaseController {

    /**
     * Display a listing of emails
     *
     * @return Response
     */
    public function index($user_id, $domain_id)
    {
        $user   = User::findOrFail($user_id);
        $domain = Domain::findOrFail($domain_id);
        $emails = Email::where('domain_id', $domain_id)->paginate(10);

        return View::make('emails.index', compact('emails', 'user', 'domain'));
    }

    /**
     * Show the form for creating a new email
     *
     * @return Response
     */
    public function create($user_id, $domain_id)
    {
        $user   = User::findOrFail($user_id);
        $domain = Domain::findOrFail($domain_id);
        return View::make('emails.create', compact('user', 'domain'));
    }

    /**
     * Store a newly created email in storage.
     *
     * @return Response
     */
    public function store($user_id, $domain_id)
    {
        $user   = User::findOrFail($user_id);
        $domain = Domain::findOrFail($domain_id);

        $email = new Email;
        $email->domain()->associate($domain);

        if ($email->save())
        {
            Session::flash('message', trans('frontend.messages.email.store.successful'));
            Auth::login($user);
            return Redirect::route('user.emails.index', array($user->id, $domain->id));
        }
        else
        {
            return Redirect::back()->withErrors($email->errors())->withInput();
        }
    }

    /**
     * Display the specified email.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($user_id, $domain_id, $id)
    {
        $user   = User::findOrFail($user_id);
        $domain = Domain::findOrFail($domain_id);
        $email  = Email::find('id');
        return View::make('emails.show', compact('user', 'domain', 'email'));
    }

    /**
     * Show the form for editing the specified email.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($user_id, $domain_id, $id)
    {
        $user   = User::findOrFail($user_id);
        $domain = Domain::findOrFail($domain_id);
        $email  = Email::find($id);

        return View::make('emails.edit', compact('email'));
    }

    /**
     * Update the specified email in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($user_id, $domain_id, $id)
    {
        $email  = Email::findOrFail($id);
        $user   = User::findOrFail($user_id);
        $domain = Domain::findOrFail($domain_id);
        $email->update($data);

        return Redirect::route('emails.index', compact('user', 'domain'));
    }

    /**
     * Remove the specified email from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($user_id, $domain_id, $id)
    {
        $user   = User::findOrFail($user_id);
        $domain = Domain::findOrFail($domain_id);
        Email::destroy($id);

        return Redirect::route('emails.index', compact('user', 'domain'));
    }

}
