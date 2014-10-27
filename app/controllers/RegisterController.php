<?php

use Illuminate\Events\Dispatcher;
//use Sph\Storage\User\UserRepository as User;

class RegisterController extends \BaseController
{

      protected $user;
      
      /*public function __construct(User $user)
      {
            parent::__construct();
            $this->user = $user;            
      }*/

      public function index()
      {
            return View::make('register.client');
      }

      /**
       * Store the client in the database
       */
      public function store_client()
      {
            $validateUser = new Sph\Services\Validators\User(Input::all(), 'save');
            $validateClient = new Sph\Services\Validators\Cliente(Input::all(), 'save');

            //Validamos datos del usuario y datos del cliente
            if ($validateUser->passes() & $validateClient->passes())
            {
                  //Creamos un usario
                  $user = $this->user->create(Input::all());
                  if (isset($user))
                  {
                        //Creamos un codigo de activación
                        $token = sha1(time());

                        //Se crea el objeto de usuario con los datos de entrada y el usuario al que pertenece
                        $cliente_model = Input::all();
                        $cliente_model = array_add($cliente_model, 'is_activo', false);
                        $cliente_model = array_add($cliente_model, 'token', $token);
                        $cliente_model = array_add($cliente_model, 'user', $user);

                        $cliente = $this->cliente->create($cliente_model);

                        if (isset($cliente))
                        {
                              $data = array('nombre' => $cliente->nombre,
                                    'token' => $cliente->token,
                                    'id' => $cliente->id,
                              );

                              Mail::send('emails.auth.confirm_new_user', $data, function($message) use ($user, $cliente) {
                                    $message->to($user->email, $cliente->nombre)->subject('Confirmación de Registro de Sphellar');
                              });
                              Session::flash('message', 'Usuario creado con éxito, revisa tu correo para activarlo');

                              return Redirect::to('/');
                        }
                  }
            }

            //Mensaje de error de validaciones
            $user_messages = ($validateUser->getErrors() != null) ? $validateUser->getErrors()->all() : array();
            $cliente_messages = ($validateClient->getErrors() != null) ? $validateClient->getErrors()->all() : array();
            $validationMessages = array_merge_recursive($user_messages, $cliente_messages);

            return Redirect::route('register.client')->withInput()->withErrors($validationMessages);
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

            $validateUser = new Sph\Services\Validators\User(Input::all(), 'save');
            $validateAdmin = new Sph\Services\Validators\Administrador(Input::all(), 'save');

            if ($validateUser->passes() & $validateAdmin->passes())
            {
                  $user_model = Input::all();
                  $user = $this->user->create($user_model);
                  if (isset($user))
                  {
                        $admin_model = Input::all();
                        $admin_model = array_add($admin_model, 'user', $user);
                        $admin = $this->administrador->create($admin_model);
                        if (isset($admin))
                        {
                              Session::flash('message', 'Usuario creado con éxito');

                              return Redirect::to('/');
                        }
                  }
            }
            $user_messages = ($validateUser->getErrors() != null) ? $validateUser->getErrors()->all() : array();
            $admin_messages = ($validateAdmin->getErrors() != null) ? $validateAdmin->getErrors()->all() : array();
            $validationMessages = array_merge_recursive($user_messages, $admin_messages);

            return Redirect::route('register.marketing')->withInput()->withErrors($validationMessages);
      }

}
