@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <ul class="nav nav-tabs" role="tablist">
            <li>{{HTML::LinkRoute('user.ftps.index',trans('frontend.link.ftp.index'),array($user->id,$domain->id))}}</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-push-3">
            <h2>{{ trans('frontend.title.ftp.create') }}</h2>

            <div class="instrucciones">
                <p>{{trans('frontend.instruction.ftp.create')}}</p>
            </div>

            {{ Form::open(array('route' => array('user.ftps.store',$user->id,$domain->id))) }}

            @include('layouts.show_form_errors')

            <div class="form-group">
                {{ Form::label('username', trans('frontend.label.username')) }}
                {{ Form::text('username',Input::old('username'),array('placeholder' => trans('frontend.placeholder.username'), 'class'=>'form-control'))}}
            </div>
            <div class="form-group">                        
                {{ Form::label('hostname', trans('frontend.label.hostname')) }}
                {{ Form::text('hostname', Input::old('hostname'), array('placeholder' => trans('frontend.placeholder.hostname'), 'class'=>'form-control')) }}
            </div>
            <div class="form-group">                        
                {{ Form::label('homedir', trans('frontend.label.homedir')) }}
                {{ Form::text('homedir', Input::old('homedir'), array('placeholder' => trans('frontend.placeholder.homedir'), 'class'=>'form-control')) }}
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
                {{Form::submit(trans('frontend.button.ftp.store.submit'),array('class'=>"btn btn-primary"))}}                        
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@include('layouts.modal_password')
@stop
