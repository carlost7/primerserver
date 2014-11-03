@extends('layouts.master')

@section('contenido')
<div class="col-sm-6 col-sm-push-3">
    <h2>{{trans('frontend.title.reminder')}}</h2>
    <div class="instrucciones">
        <p>{{trans('frontend.instruction.reminder')}}</p>
    </div>
    {{Form::open(array('action'=>'RemindersController@postRemind','method'=>'POST'))}}
    <div class="form-group">
        {{ Form::label('email', trans('frontend.label.email')) }}
        {{ Form::text('email', Input::old('email'), array('placeholder' => trans('frontend.placeholder.email'), 'class'=>'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::submit(trans('frontend.button.reminder.submit'),array("class"=>"btn btn-primary")) }}        
    </div>              
    {{Form::close()}}
</div>
@stop

