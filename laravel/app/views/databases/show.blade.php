@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <ul class="nav nav-tabs" role="tablist">
            <li>{{HTML::LinkRoute('user.databases.index',trans('frontend.link.database.index'),array($user->id,$domain->id))}}</li>                  
            <li>{{ HTML::linkRoute('user.databases.edit',trans('frontend.link.database.edit'),array($user->id,$domain->id,$database->id)) }}</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-push-3">
            <h2>{{ trans('frontend.title.database.show',array('database'=>$database->database)) }}</h2>
            <h2>{{ $database->user_database }}</h2>
            <h2>{{ $database->forward }}</h2>
            <h2>{{ "Espacio disponible" }}</h2>            
        </div>
    </div>
</div>
@stop