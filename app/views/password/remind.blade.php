@extends('layouts.master')

@section('contenido')
<div class="col-sm-6 col-sm-push-3">
    <h2>{{trans('frontend.reminder.title')}}</h2>
    <div class="instrucciones">
        <p>{{trans('frontend.reminder.instructions')}}</p>
    </div>
    {{Form::open(array('action'=>'RemindersController@postRemind','method'=>'POST'))}}
    <div class="form-group">
        {{ Form::label('email', trans('frontend.label_email')) }}
        {{ Form::text('email', Input::old('email'), array('placeholder' => trans('frontend.placeholder_email'), 'class'=>'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::submit(trans('frontend.reminder.submit'),array("class"=>"btn btn-primary")) }}        
    </div>              
    {{Form::close()}}
</div>
@stop

