<?php

/*
  |--------------------------------------------------------------------------
  | Application & Route Filters
  |--------------------------------------------------------------------------
  |
  | Below you will find the "before" and "after" events for the application
  | which may be used to do any work before or after a request into your
  | application. Here you may also register your custom route filters.
  |
 */

App::before(function($request) {
    //
});


App::after(function($request, $response) {
    //
});

/*
  |--------------------------------------------------------------------------
  | Authentication Filters
  |--------------------------------------------------------------------------
  |
  | The following filters are used to verify that the user of the current
  | session is logged into this application. The "basic" filter easily
  | integrates HTTP Basic authentication for quick, simple checking.
  |
 */

Route::filter('auth', function() {
    if (Auth::guest())
    {
        if (Request::ajax())
        {
            return Response::make('Unauthorized', 401);
        }
        else
        {
            return Redirect::guest('login');
        }
    }
});


Route::filter('auth.basic', function() {
    return Auth::basic();
});

/*
  |--------------------------------------------------------------------------
  | Guest Filter
  |--------------------------------------------------------------------------
  |
  | The "guest" filter is the counterpart of the authentication filters as
  | it simply checks that the current user is not logged in. A redirect
  | response will be issued if they are, which you may freely change.
  |
 */

Route::filter('guest', function() {
    if (Auth::check())
        return Redirect::to('/');
});

/*
  |--------------------------------------------------------------------------
  | CSRF Protection Filter
  |--------------------------------------------------------------------------
  |
  | The CSRF filter is responsible for protecting your application against
  | cross-site request forgery attacks. If this special token in a user
  | session does not match the one given in this request, we'll bail.
  |
 */

Route::filter('csrf', function() {
    if (Session::token() != Input::get('_token'))
    {
        throw new Illuminate\Session\TokenMismatchException;
    }
});

/*
 *    Check if user is the same as auth
 * 
 * 
 */

Route::filter('is_same_user', function($route, $request) {
    if ($route->getParameter('user_id') != '')
    {
        if ($route->getParameter('user_id') != Auth::user()->id && Auth::user()->type == 'User')
        {
            Session::flash('error', trans('frontend.filter.not_same_user'));
            return Redirect::back();
        }
    }
});

/*
 *    Check if domain belongs to user
 * 
 * 
 */

Route::filter('domain_belongs_to_user', function($route, $request) {
    //dd($route->getParameter('user_id'));    
    if ($route->getParameter('domain_id') != '')
    {
        $domain = Domain::find($route->getParameter('domain_id'));
        if ($domain->user->id != $route->getParameter('user_id'))
        {
            Session::flash('error', trans('frontend.filter.not_user_domain'));
            return Redirect::back();
        }        
        if ($domain->active)
        {
            Session::flash('error', trans('frontend.filter.not_user_domain'));
            return Redirect::back();
        }
    }
});

/*
 *    Check if object belongs to domain
 * 
 * 
 */

Route::filter('object_belongs_to_domain', function($route, $request) {

    //dd($route->getParameter('user_id'));
    if ($route->getParameter('object_id') != '')
    {
        $user = User::with('domains')->find($route->getParameter('user_id'));
        if (!in_array($value, $user->domains->lists('id')))
        {
            Session::flash('error', trans('frontend.filter.not_user_element'));
            return Redirect::back();
        }
    }
});


/*
 * 
 *    Check if user is admin
 * 
 * 
 */

Route::filter('is_admin', function() {
    if (Auth::user()->type != 'Admin')
    {
        Session::flash('error', trans("filter.is_admin"));
        return Redirect::route('login');
    }
});


