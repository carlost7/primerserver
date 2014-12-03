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
Route::get('/', array(
    'uses' => 'SessionController@index',
    'as'   => 'index'
));

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

Route::any('payment/receive_payment_test', array(
    'uses' => 'ReceivedPaymentController@update',
    'as'   => 'receive_payment.update'
));

Route::any('payment/receive_payment', array(
    'uses' => 'ReceivedPaymentController@store',
    'as'   => 'receive_payment.store'
));

Route::any('payment/realized_payment/{user_id}', array(
    'uses' => 'ReceivedPaymentController@index',
    'as'   => 'receive_payment.index'
));

Route::any('checkdomain/{domain?}', array(
    'uses' => 'CheckdomainsController@show',
    'as'   => 'checkdomain.check'
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
                  Route::get('user/domains/{user_id}/{id}', array('before' => 'object_belongs_to_domain',
                      'as'     => 'user.domains.show',
                      'uses'   => 'DomainsController@show'));
                  Route::get('user/domains/{user_id}/{id}/edit', array('as'   => 'user.domains.edit',
                      'uses' => 'DomainsController@edit'));
                  Route::put('user/domains/{user_id}/{id}', array('as'   => 'user.domains.update',
                      'uses' => 'DomainsController@update'));
                  Route::delete('user/domains/{user_id}/{id}', array('as'   => 'user.domains.destroy',
                      'uses' => 'DomainsController@destroy'));

                  //Payments
                  Route::get('user/payments/{user_id}', array('as'   => 'user.payments.index',
                      'uses' => 'PaymentsController@index'));
                  Route::get('user/payments/{user_id}/{no_order}', array('as'   => 'user.payments.show',
                      'uses' => 'PaymentsController@show'));
                  Route::put('user/payments/{user_id}/{no_order}', array('as'   => 'user.payments.update',
                      'uses' => 'PaymentsController@update'));
                  Route::delete('user/payments/{user_id}/{no_order}', array('as'   => 'user.payments.destroy',
                      'uses' => 'PaymentsController@destroy'));

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
                        //Ftps
                        Route::get('user/ftps/{user_id}/{domain_id}', array('as'   => 'user.ftps.index',
                            'uses' => 'FtpsController@index'));
                        Route::get('user/ftps/{user_id}/{domain_id}/create', array('as'   => 'user.ftps.create',
                            'uses' => 'FtpsController@create'));
                        Route::post('user/ftps/{user_id}/{domain_id}', array('as'   => 'user.ftps.store',
                            'uses' => 'FtpsController@store'));
                        Route::get('user/ftps/{user_id}/{domain_id}/{id}', array('as'   => 'user.ftps.show',
                            'uses' => 'FtpsController@show'));
                        Route::get('user/ftps/{user_id}/{domain_id}/{id}/edit', array('as'   => 'user.ftps.edit',
                            'uses' => 'FtpsController@edit'));
                        Route::put('user/ftps/{user_id}/{domain_id}/{id}', array('as'   => 'user.ftps.update',
                            'uses' => 'FtpsController@update'));
                        Route::delete('user/ftps/{user_id}/{domain_id}/{id}', array('as'   => 'user.ftps.destroy',
                            'uses' => 'FtpsController@destroy'));
                        Route::get('user/ftps/config/{user_id}/{domain_id}/{id}/{app}', array('as'   => 'user.ftps.config.show',
                            'uses' => 'FtpsConfigController@show'));
                        //Databases
                        Route::get('user/databases/{user_id}/{domain_id}', array('as'   => 'user.databases.index',
                            'uses' => 'DatabasesController@index'));
                        Route::get('user/databases/{user_id}/{domain_id}/create', array('as'   => 'user.databases.create',
                            'uses' => 'DatabasesController@create'));
                        Route::post('user/databases/{user_id}/{domain_id}', array('as'   => 'user.databases.store',
                            'uses' => 'DatabasesController@store'));
                        Route::get('user/databases/{user_id}/{domain_id}/{id}', array('as'   => 'user.databases.show',
                            'uses' => 'DatabasesController@show'));
                        Route::get('user/databases/{user_id}/{domain_id}/{id}/edit', array('as'   => 'user.databases.edit',
                            'uses' => 'DatabasesController@edit'));
                        Route::put('user/databases/{user_id}/{domain_id}/{id}', array('as'   => 'user.databases.update',
                            'uses' => 'DatabasesController@update'));
                        Route::delete('user/databases/{user_id}/{domain_id}/{id}', array('as'   => 'user.databases.destroy',
                            'uses' => 'DatabasesController@destroy'));
                  });
            });
      });

      Route::any('get_password', array('as' => 'password.show', 'uses' => 'PasswordController@show'));


      Route::group(array('prefix' => 'administrador'), function() {
            Route::resource('domain_costs', 'DomainCostsController');
      });
});
