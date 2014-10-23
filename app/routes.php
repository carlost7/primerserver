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

Route::get('/', function()
{
      return View::make('hello');
});

Route::get('login',array('as'=>'login','uses'=>'LoginController'));


Route::group(array('before' => 'auth'), function()
{
      
      Route::group(array('prefix'=>'cliente','before'=>'is_cliente'),function(){
            
      });
      
      Route::group(array('prefix'=>'administrador','before'=>'is_admin'),function(){
            
      });
      
      
      
});
