@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <ul class="nav nav-tabs" role="tablist">
            <li>{{HTML::LinkRoute('user.emails.index',trans('frontend.link.emails_index'),array($user->id,$domain->id))}}</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-push-3">
            <h2>{{ trans('frontend.email.create.title') }}</h2>

            <div class="instrucciones">
                <p>{{trans('frontend.email.create.instructions')}}</p>
            </div>

            {{ Form::open(array('route' => array('user.emails.store',$user->id,$domain->id))) }}

            @include('layouts.show_form_errors')

            <div class="form-group">                        
                {{ Form::label('email', trans('frontend.label_domain')) }}
                {{ Form::text('email', Input::old('email'), array('placeholder' => trans('frontend.placeholder_email'), 'class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('forward', trans('frontend.label_forward')) }}
                {{ Form::text('forward',Input::old('forward'),array('placeholder' => trans('frontend.placeholder_forward'), 'class'=>'form-control'))}}
            </div>            
            <div class="form-group">
                {{ Form::label('password', trans('frontend.label_password')) }}
                <div class="input-group">
                    {{ Form::password('password',array('placeholder' => trans('frontend.placeholder_password'), 'class'=>'form-control', 'id'=>'password')) }}
                    <span class="input-group-btn">
                        {{ Form::button(trans('frontend.passwords.generate'),array('class'=>"btn btn-primary",'data-target'=>"#ModalPassword",'on_click'=>'get_password()','data-toggle'=>"modal")) }}                        
                    </span>                  
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('password_confirmation', trans('frontend.label_password_confirmation')) }}
                {{ Form::password('password_confirmation',array('placeholder' => trans('frontend.placeholder_password_confirmation'), 'class'=>'form-control', 'id' => 'confirm_password')) }}
            </div>
            <div class="form-group">
                {{Form::submit(trans('frontend.emails.create.submit'),array('class'=>"btn btn-primary"))}}                        
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@include('layouts.modal_password')
@stop
