@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h2>{{$domain->domain}}</h2>
        </div>
    </div>
    
    <div class="row"> 
        
        @include('layouts.menu', ['page' => 'principal'])
        
        <div class="col-sm-4">
            <h2>{{ HTML::linkRoute('user.emails.index',trans('frontend.link.email.index'),array('user_id'=>$user->id,'domain_id'=>$domain->id)) }}</h2>
            <h2>{{ count($domain->emails)."/".$domain->plan->num_emails }}</h2>
            <h2>{{ HTML::linkRoute('user.emails.create',trans('frontend.link.email.create'),array('user_id'=>$user->id,'domain_id'=>$domain->id)) }}</h2>

        </div>
        <div class="col-sm-4">
            <h2>{{ HTML::linkRoute('user.databases.index',trans('frontend.link.database.index'),array('user_id'=>$user->id,'domain_id'=>$domain->id)) }}</h2>
            <h2>{{ count($domain->databases)."/".$domain->plan->num_databases }}</h2>
            <h2>{{ HTML::linkRoute('user.databases.create',trans('frontend.link.database.create'),array('user_id'=>$user->id,'domain_id'=>$domain->id)) }}</h2>
        </div>
        <div class="col-sm-4">
            <h2>{{ HTML::linkRoute('user.ftps.index',trans('frontend.link.ftp.index'),array('user_id'=>$user->id,'domain_id'=>$domain->id)) }}</h2>
            <h2>{{ count($domain->ftps)."/".$domain->plan->num_ftps }}</h2>
            <h2>{{ HTML::linkRoute('user.ftps.create',trans('frontend.link.ftp.create'),array('user_id'=>$user->id,'domain_id'=>$domain->id)) }}</h2>
        </div>
    </div>
</div>
@stop
