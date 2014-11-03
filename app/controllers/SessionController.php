<?php

//use Sph\Authenticators\Manager;

class SessionController extends \BaseController {

    protected $user;
    protected $manager;

    public function __construct()
    {
        /* $this->user = $user;
          $this->manager = $manager; */
    }

    public function index()
    {
        if (Auth::check())
        {
            return Redirect::route('user.show', Auth::user()->id);
        }
        else
        {
            return View::make('index');
        }
    }

    /**
     * Display a listing of the resource.
     * GET /session
     *
     * @return Response
     */
    public function create()
    {
        return View::make('session.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /session
     *
     * @return Response
     */
    public function store()
    {
        if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')), Input::get('rememberme')))
        {
            switch (Auth::user()->type) {
                case 'User':
                    return Redirect::intended(route('user.show', Auth::user()->id));
                    break;
                case 'Admin':
                    return Redirect::intended(route('user.show', Auth::user()->id));
                    break;
                default:
                    return Redirect::to('/');
                    break;
            }
        }
        return Redirect::route('index')
                        ->withInput()
                        ->with('login_errors', true);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /session/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {
        Auth::logout();
        Session::flash('message', trans('frontend.messages.logout'));
        return Redirect::to('/');
    }

}
