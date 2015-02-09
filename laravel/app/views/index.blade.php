@extends('layouts.master')

@section('contenido')

<div class="container topic site intro">

    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
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
                    <label class="show">
                        <input type="checkbox" name="rememberme" value="1"> {{trans('frontend.label.keep_alive')}}
                    </label>
                </div>
            </div>                  
            @if (Session::has('login_errors'))
            <div class="alert alert-danger">{{ trans('frontend.messages.login.error') }}</div>
            @endif                
            <div class="form-group clearfix text-center ">
                <div class="col-md-6 mrg-bottom-20">
                {{ Form::submit(trans('frontend.button.login.submit'),array("class"=>"btn btn-primary")) }}
                </div>
                
                <div class="col-md-6 ">
                {{ HTML::LinkRoute('register.index',trans('frontend.link.register'),null,array('class'=>'btn btn-primary ')) }}
                </div>
            </div>      
            
            <div class="text-center clearfix mrg-top-20">
                 {{ HTML::linkAction('RemindersController@getRemind',trans('frontend.link.reminder_password'))}}
            </div>
            {{ Form::close() }}
        </div>

        <!--<div class="col-sm-6 ">
            <h1>{{trans('frontend.title.index2')}}</h1>
            
        </div>            -->

    </div>

</div>

@stop