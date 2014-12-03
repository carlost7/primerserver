@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <ul class="nav nav-tabs" role="tablist">
            <li>{{HTML::LinkRoute('user.emails.index',trans('frontend.link.email.index'),array($user->id,$domain->id))}}</li>                  
            <li>{{ HTML::linkRoute('user.emails.edit',trans('frontend.link.email.edit'),array($user->id,$domain->id,$email->id)) }}</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-push-3">
            <h2>{{ trans('frontend.title.email.show',array('email'=>$email->email)) }}</h2>
            <h2>{{ $email->user_email }}</h2>
            <h2>{{ $email->forward }}</h2>
            <h2>{{ "Espacio disponible" }}</h2>            
        </div>
    </div>
</div>
@stop