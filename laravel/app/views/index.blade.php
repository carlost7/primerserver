@extends('layouts.master')

@section('contenido')

<div class="container">

    <div class="row">
        <div class="col-sm-6">
            <h1>{{trans('frontend.title.index1')}}</h1>
            {{ Form::open(array('route' => 'session.store')) }}        
            <div class="form-group">
                {{ Form::label('email', trans('frontend.label.email')) }}
                {{ Form::text('email', Input::old('email'), array('placeholder' => trans('frontend.placeholder.logemail'), 'class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('password', trans('frontend.label.password')) }}
                {{ Form::password('password',array('placeholder' => trans('frontend.placeholder.logpassword'), 'class'=>'form-control')) }}
            </div> 
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="rememberme" value="1"> {{trans('frontend.label.keep_alive')}}
                    </label>
                </div>
            </div>                  
            @if (Session::has('login_errors'))
            <div class="alert alert-danger">{{ trans('frontend.messages.login.error') }}</div>
            @endif                
            <div class="form-group">
                {{ Form::submit(trans('frontend.button.login.submit'),array("class"=>"btn btn-primary")) }}
                {{ HTML::linkAction('RemindersController@getRemind',trans('frontend.link.reminder_password'))}}
            </div>                        
            {{ Form::close() }}
        </div>

        <div class="col-sm-6">
            <h1>{{trans('frontend.title.index2')}}</h1>
            <div class="text-center">
                {{ HTML::LinkRoute('register.index',trans('frontend.link.register'),null,array('class'=>'btn btn-primary btn-lg')) }}                                          
            </div>
        </div>            

    </div>

</div>

@stop