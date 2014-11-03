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
Route::get('/', array('uses' => 'SessionController@index', 'as' => 'index'));

/*
 * Login Users routes
 */
Route::get('login', array(
    'uses' => 'SessionController@create',
    'as'   => 'session.create'
));

Route::post('login', array(
    'uses' => 'SessionController@store',
    'as'   => 'session.store'
));

Route::get('logout', array(
    'uses' => 'SessionController@destroy',
    'as'   => 'session.destroy'
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
    'as'   => 'register.index'
));
Route::get('registrar/cliente', array(
    'uses' => 'RegisterController@index',
    'as'   => 'register.user'
));
Route::post('registrar/cliente', array(
    'uses' => 'RegisterController@store_user',
    'as'   => 'register.store_user'
));

//check auth user
Route::group(array('before' => 'auth'), function() {

    //Check user 
    Route::group(array('before' => 'is_same_user'), function() {

        //User controller routes
        Route::get('user/{user_id}', array('as'   => 'user.show',
            'uses' => 'UserController@show'));
        Route::get('user/{user_id}/edit', array('as'   => 'user.edit',
            'uses' => 'UserController@edit'));
        Route::put('user/{user_id}', array('as'   => 'user.update',
            'uses' => 'UserController@update'));
        Route::delete('user/{user_id}', array('as'   => 'user.destroy',
            'uses' => 'UserController@destroy'));

        //Check if domain belongs to user
        Route::group(array('before' => 'domain_belongs_to_user'), function() {

            //Domains
            Route::get('user/domains/{user_id}', array('as'   => 'user.domains.index',
                'uses' => 'DomainsController@index'));
            Route::get('user/domains/{user_id}/create', array('as'   => 'user.domains.create',
                'uses' => 'DomainsController@create'));
            Route::post('user/domains/{user_id}', array('as'   => 'user.domains.store',
                'uses' => 'DomainsController@store'));
            Route::get('user/domains/{user_id}/{id}', array('as'   => 'user.domains.show',
                'uses' => 'DomainsController@show'));
            Route::get('user/domains/{user_id}/{id}/edit', array('as'   => 'user.domains.edit',
                'uses' => 'DomainsController@edit'));
            Route::put('user/domains/{user_id}/{id}', array('as'   => 'user.domains.update',
                'uses' => 'DomainsController@update'));
            Route::delete('user/domains/{user_id}/{id}', array('as'   => 'user.domains.destroy',
                'uses' => 'DomainsController@destroy'));

            Route::group(array('before' => 'object_belongs_to_domain'), function() {
                //Emails
                Route::get('user/emails/{user_id}/{domain_id}', array('as'   => 'user.emails.index',
                    'uses' => 'EmailsController@index'));
                Route::get('user/emails/{user_id}/{domain_id}/create', array('as'   => 'user.emails.create',
                    'uses' => 'EmailsController@create'));
                Route::post('user/emails/{user_id}/{domain_id}', array('as'   => 'user.emails.store',
                    'uses' => 'EmailsController@store'));
                Route::get('user/emails/{user_id}/{domain_id}/{id}', array('as'   => 'user.emails.show',
                    'uses' => 'EmailsController@show'));
                Route::get('user/emails/{user_id}/{domain_id}/{id}/edit', array('as'   => 'user.emails.edit',
                    'uses' => 'EmailsController@edit'));
                Route::put('user/emails/{user_id}/{domain_id}/{id}', array('as'   => 'user.emails.update',
                    'uses' => 'EmailsController@update'));
                Route::delete('user/emails/{user_id}/{domain_id}/{id}', array('as'   => 'user.emails.destroy',
                    'uses' => 'EmailsController@destroy'));
            });
        });
    });


    Route::group(array('prefix' => 'administrador', 'before' => 'is_admin'), function() {
        
    });
});
