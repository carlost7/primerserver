@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <ul class="nav nav-tabs" role="tablist">
            <li>{{HTML::LinkRoute('user.ftps.index',trans('frontend.link.ftp.index'),array($user->id,$domain->id))}}</li>                  
            <li>{{ HTML::linkRoute('user.ftps.edit',trans('frontend.link.ftp.edit'),array($user->id,$domain->id,$ftp->id)) }}</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-push-3">
            <h2>{{ trans('frontend.title.ftp.show',array('ftp'=>$ftp->username)) }}</h2>
            <h2>{{ $ftp->hostname }}</h2>
            <h2>{{ $ftp->homedir }}</h2>
            <h2>{{ "Espacio disponible" }}</h2>            
        </div>
    </div>
</div>
@stop