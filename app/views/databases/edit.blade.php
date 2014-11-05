@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <ul class="nav nav-tabs" role="tablist">
            <li>{{HTML::LinkRoute('user.databases.index',trans('frontend.link.database.index'),array($user->id,$domain->id))}}</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-push-3">
            <h2>{{ trans('frontend.title.database.edit',array('database'=>$database->database)) }}</h2>

            <div class="instrucciones">
                <p>{{trans('frontend.instruction.database.edit')}}</p>
            </div>

            {{ Form::model($database,array("route" => array('user.databases.update',$user->id,$domain->id,$database->id),"method"=>'PUT')) }}

            @include('layouts.show_form_errors')
            <div class="form-group">
                {{ Form::label('name_db', trans('frontend.label.name_db')) }}
                {{ Form::text('name_db',Input::old('name_db'),array('placeholder' => trans('frontend.placeholder.name_db'), 'class'=>'form-control'))}}
            </div>
            <div class="form-group">
                {{ Form::label('user', trans('frontend.label.user')) }}
                {{ Form::text('user',Input::old('user'),array('placeholder' => trans('frontend.placeholder.user'), 'class'=>'form-control'))}}
            </div>
            <div class="form-group">
                {{ Form::label('password', trans('frontend.label.password')) }}
                <div class="input-group">
                    {{ Form::password('password',array('placeholder' => trans('frontend.placeholder.password'), 'class'=>'form-control', 'id'=>'password')) }}
                    <span class="input-group-btn">
                        {{ Form::button(trans('frontend.button.modal_password.generate_new'),array('class'=>"btn btn-primary",'data-target'=>"#ModalPassword",'on_click'=>'get_password()','data-toggle'=>"modal")) }}                        
                    </span>                  
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('password_confirmation', trans('frontend.label.password_confirmation')) }}
                {{ Form::password('password_confirmation',array('placeholder' => trans('frontend.placeholder.password_confirmation'), 'class'=>'form-control', 'id' => 'confirm_password')) }}
            </div>
            <div class="form-group">
                {{Form::submit(trans('frontend.button.database.update.submit'),array('class'=>"btn btn-primary"))}}                        
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@include('layouts.modal_password')
@stop
