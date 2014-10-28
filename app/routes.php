<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */
//Main redirection
Route::get('/', array('uses'=>'SessionController@index','as'=>'index'));

/*
 * Login Users routes
 */
Route::get('login', array(
    'uses' => 'SessionController@create',
    'as' => 'session.create'
));

Route::post('login', array(
    'uses' => 'SessionController@store',
    'as' => 'session.store'
));

Route::get('logout', array(
    'uses' => 'SessionController@destroy',
    'as' => 'session.destroy'
));

//Reminder Controller
Route::controller('password', 'RemindersController');

/*
 * ****************************
 *      Registro de usuarios
 * ****************************
 */
Route::get('registrar', array(
    'uses' => 'RegisterController@index',
    'as' => 'register.index'
));
Route::get('registrar/cliente', array(
    'uses' => 'RegisterController@index',
    'as' => 'register.user'
));
Route::post('registrar/cliente', array(
    'uses' => 'RegisterController@store_user',
    'as' => 'register.store_user'
));

Route::group(array('before' => 'auth'), function()
{
      
      Route::group(array('before'=>'is_user'),function(){
            
            Route::resource('user','UserController',array('except'=>array('index','create','store')));
            
      });
      
      Route::group(array('prefix'=>'administrador','before'=>'is_admin'),function(){
            
      });
      
      
      
});
