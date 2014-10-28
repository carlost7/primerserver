@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <ul class="nav nav-tabs" role="tablist">
            <li>{{HTML::LinkRoute('user.edit',trans('frontend.link.user_edit'),array(Auth::user()->id))}}</li>
            <li><a href="#">Pagos</a></li>
            <li><a href="#">Mensajes</a></li>
        </ul>
    </div>
    <div class="row">
        Mostrar todos los dominios
    </div>
</div>
@stop