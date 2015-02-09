@extends('layouts.master')

@section('contenido')
<div class="container  first ">
    <div class="row">
        <div class="col-sm-6 col-sm-push-3">
            <h2>{{ trans('frontend.title.register') }}</h2>

            <!--
            <div class="instrucciones">
                <p>{{trans('frontend.instruction.register')}}</p>
            </div>
            -->
            
            {{ Form::open(array('route' => 'register.store_user')) }}

            @include('layouts.show_form_errors')

            <div class="row">
                <div class="form-group col-sm-6">
                    {{ Form::label('first_name', trans('frontend.label.first_name')) }}
                    {{ Form::text('first_name', Input::old('nombre'), array('placeholder' => trans('frontend.placeholder.first_name'), 'class'=>'form-control')) }}
                </div>
                <div class="form-group col-sm-6">
                    {{ Form::label('last_name', trans('frontend.label.last_name')) }}
                    {{ Form::text('last_name', Input::old('apellido'), array('placeholder' => trans('frontend.placeholder.last_name'), 'class'=>'form-control')) }}
                </div>
            </div>                  
            <div class="form-group">                        
                {{ Form::label('telephone', trans('frontend.label.telephone')) }}
                {{ Form::text('telephone', Input::old('telephone'), array('placeholder' => trans('frontend.placeholder.telephone'), 'class'=>'form-control')) }}                        
            </div>
            <div class="form-group">
                {{ Form::label('cellphone', trans('frontend.label.cellphone')) }}
                {{ Form::text('cellphone', Input::old('cellphone'), array('placeholder' => trans('frontend.placeholder.cellphone'), 'class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('email', trans('frontend.label.email')) }}
                {{ Form::text('email', Input::old('email'), array('placeholder' => trans('frontend.placeholder.email'), 'class'=>'form-control')) }}
            </div>            
            <div class="form-group">
                {{ Form::label('password', trans('frontend.label.password')) }}
                {{ Form::password('password',array('placeholder' => trans('frontend.placeholder.password'), 'class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('password_confirmation', trans('frontend.label.password_confirmation')) }}
                {{ Form::password('password_confirmation',array('placeholder' => trans('frontend.placeholder.password_confirmation'), 'class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{Form::submit(trans('frontend.button.register.submit'),array('class'=>"btn btn-primary"))}}                        
            </div>        
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop
