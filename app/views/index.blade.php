@extends('layouts.master')

@section('contenido')

<div class="container">

      <div class="row">
            <div class="col-sm-6">
                  <h1>{{trans('frontend.index.title1')}}</h1>
                  {{ Form::open(array('route' => 'session.store')) }}        
                  <div class="form-group">
                        {{ Form::label('email', trans('frontend.label_email')) }}
                        {{ Form::text('email', Input::old('email'), array('placeholder' => trans('frontend.placeholder_login_email'), 'class'=>'form-control')) }}
                  </div>
                  <div class="form-group">
                        {{ Form::label('password', trans('frontend.label_password')) }}
                        {{ Form::password('password',array('placeholder' => trans('frontend.placeholder_login_password'), 'class'=>'form-control')) }}
                  </div> 
                  <div class="form-group">
                        <div class="checkbox">
                              <label>
                                    <input type="checkbox" name="rememberme" value="1"> {{trans('frontend.label_keep_alive')}}
                              </label>
                        </div>
                  </div>                  
                  @if (Session::has('login_errors'))
                  <div class="alert alert-danger">{{ trans('frontend.login.error') }}</div>
                  @endif                
                  <div class="form-group">
                        {{ Form::submit(trans('frontend.login.submit'),array("class"=>"btn btn-primary")) }}
                        {{ HTML::linkAction('RemindersController@getRemind',trans('frontend.link.reminder_password'))}}
                  </div>                        
                  {{ Form::close() }}
            </div>
          
            <div class="col-sm-6">
                  <h1>{{trans('frontend.index.title2')}}</h1>
                  <div class="text-center">
                        {{ HTML::LinkRoute('register.index',trans('frontend.link.register'),null,array('class'=>'btn btn-primary btn-lg')) }}                                          
                  </div>
            </div>            

      </div>

</div>

@stop