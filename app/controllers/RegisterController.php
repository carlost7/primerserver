<?php

use Illuminate\Events\Dispatcher;

class RegisterController extends \BaseController {

    protected $user;

    /* public function __construct(User $user)
      {
      parent::__construct();
      $this->user = $user;
      } */

    public function index()
    {
        return View::make('register.user');
    }

    /**
     * Store the client in the database
     */
    public function store_user()
    {
        $user       = new User;
        $user->type = "User";
        if ($user->save())
        {
            Session::flash('message', trans('frontend.register.successful'));
            Auth::login($user);
            return Redirect::route("user.show", $user->id);
        }
        else
        {
            return Redirect::back()->withErrors($user->errors())->withInput();
        }
    }

    /*
     * Display the form for marketing registry
     */

    public function register_admin()
    {
        return View::make('register.admin');
    }

    /*
     * Store the new admin user in the database
     */

    public function store_admin()
    {

        $validateUser  = new Sph\Services\Validators\User(Input::all(), 'save');
        $validateAdmin = new Sph\Services\Validators\Administrador(Input::all(), 'save');

        if ($validateUser->passes() & $validateAdmin->passes())
        {
            $user_model = Input::all();
            $user       = $this->user->create($user_model);
            if (isset($user))
            {
                $admin_model = Input::all();
                $admin_model = array_add($admin_model, 'user', $user);
                $admin       = $this->administrador->create($admin_model);
                if (isset($admin))
                {
                    Session::flash('message', 'Usuario creado con éxito');

                    return Redirect::to('/');
                }
            }
        }
        $user_messages      = ($validateUser->getErrors() != null) ? $validateUser->getErrors()->all() : array();
        $admin_messages     = ($validateAdmin->getErrors() != null) ? $validateAdmin->getErrors()->all() : array();
        $validationMessages = array_merge_recursive($user_messages, $admin_messages);

        return Redirect::route('register.marketing')->withInput()->withErrors($validationMessages);
    }

}
