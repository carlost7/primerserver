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
            <h2>{{ trans('frontend.title.ftp.edit',array('ftp'=>$ftp->ftp)) }}</h2>

            <div class="instrucciones">
                <p>{{trans('frontend.instruction.ftp.edit')}}</p>
            </div>

            {{ Form::model($ftp,array("route" => array('user.ftps.update',$user->id,$domain->id,$ftp->id),"method"=>'PUT')) }}

            @include('layouts.show_form_errors')
            <div class="form-group">
                {{ Form::label('username', trans('frontend.label.username')) }}
                {{ Form::text('username',$ftp->username."@".$ftp->hostname,array('placeholder' => trans('frontend.placeholder.username'), 'class'=>'form-control',"disabled"=>'disabled'))}}
            </div>
            <div class="form-group">                        
                {{ Form::label('homedir', trans('frontend.label.homedir')) }}
                {{ Form::text('homedir', Input::old('homedir'), array('placeholder' => trans('frontend.placeholder.homedir'), 'class'=>'form-control',"disabled"=>'disabled')) }}
            </div>
            <div class="form-group">
                {{ Form::label('password', trans('frontend.label.password')) }}
                <div class="input-group">
                    {{ Form::password('password',array('placeholder' => trans('frontend.placeholder.password'), 'class'=>'form-control', 'id'=>'password')) }}
                    <span class="input-group-btn">
                        {{ Form::button(trans('frontend.button.modal_password.generate_new'),array('class'=>"btn btn-primary",'data-target'=>"#ModalPassword",'onclick'=>'get_password()','data-toggle'=>"modal")) }}                        
                    </span>                  
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('password_confirmation', trans('frontend.label.password_confirmation')) }}
                {{ Form::password('password_confirmation',array('placeholder' => trans('frontend.placeholder.password_confirmation'), 'class'=>'form-control', 'id' => 'password_confirmation')) }}
            </div>            
            <div class="form-group">
                {{Form::submit(trans('frontend.button.ftp.update.submit'),array('class'=>"btn btn-primary"))}}                        
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@include('layouts.modal_password')
@stop
