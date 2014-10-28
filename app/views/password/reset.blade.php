@extends('layouts.master')

@section('contenido')
<div class="col-sm-6 col-sm-push-3">
    <h2>{{trans('frontend.reset_password.title')}}</h2>
    <div class="instrucciones">
        <p>{{trans('frontend.reset_password.instructions')}}</p>
    </div>
    {{ Form::open(array('action'=>'RemindersController@postReset','method'=>'POST')) }}
        {{ Form::hidden('token',$token) }}
        @include('layouts.show_form_errors')
        <div class="form-group">
            {{ Form::label('email', trans('frontend.label_email')) }}
            {{ Form::text('email', Input::old('email'), array('placeholder' => trans('frontend.placeholder_email'), 'class'=>'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('password', trans('frontend.label_password')) }}
            {{ Form::password('password',array('placeholder' => trans('frontend.placeholder_password'), 'class'=>'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('password_confirmation', trans('frontend.label_password_confirmation')) }}
            {{ Form::password('password_confirmation',array('placeholder' => trans('frontend.placeholder_password_confirmation'), 'class'=>'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::submit(trans('frontend.reset_password.submit'),array("class"=>"btn btn-primary"))}}            
        </div>                
    </form>
</div>
@stop

