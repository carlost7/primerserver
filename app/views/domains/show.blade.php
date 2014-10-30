@extends('layouts.master')

@section('contenido')
<div class="container">
      <div class="row">
            <ul class="nav nav-tabs" role="tablist">
                  <li>{{HTML::LinkRoute('user.domains.index',trans('frontend.link.domain_index'),$user->id)}}</li>
            </ul>
      </div>
      <div class="row">
            <div class="col-xs-12">
                  <h2>{{$domain->domain}}</h2>
            </div>
      </div>
      <div class="row">            
            <div class="col-sm-4">
                  <h2>{{ HTML::linkRoute('user.emails.index',trans('frontend.links.mails.index'),array($user->id,$domain->id)) }}</h2>

            </div>
            <div class="col-sm-4">
                  <h2>{{ trans('frontend.links.databases.index') }}</h2>             
                  <h2>{{ trans('frontend.links.databases.create') }}</h2>                  
            </div>
            <div class="col-sm-4">
                  <h2>{{ trans('frontend.links.ftps.index') }}</h2>                  
                  <h2>{{ trans('frontend.links.ftps.create') }}</h2>                  
            </div>
      </div>
</div>
@stop