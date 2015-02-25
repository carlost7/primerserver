@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-md-12  domain-name-title">
            <h2>{{$domain->domain}}</h2>
        </div>
    </div>
    
    <div class="row"> 
            
        @include('layouts.menu', ['page' => 'principal'])
        
        <div class="col-md-8 sidebar contenido list-table">
        
            <div class="col-sm-4">
                <a href="{{route('user.emails.create',array('user_id'=>$user->id,'domain_id'=>$domain->id))}}">{{ HTML::image('img/mail-icon.png')}} </a>
                <h3>{{ HTML::linkRoute('user.emails.index',trans('frontend.link.email.index'),array('user_id'=>$user->id,'domain_id'=>$domain->id)) }}</h3>
                <h4>{{ count($domain->emails)."/".$domain->plan->num_emails }}</h4>
            <!--    <h2>{{ HTML::linkRoute('user.emails.create',trans('frontend.link.email.create'),array('user_id'=>$user->id,'domain_id'=>$domain->id)) }}</h2> -->

            </div>
            <div class="col-sm-4">
                <a href="{{route('user.databases.create',array('user_id'=>$user->id,'domain_id'=>$domain->id))}}">{{ HTML::image('img/db-icon.png')}}</a>
                <h3>{{ HTML::linkRoute('user.databases.index',trans('frontend.link.database.index'),array('user_id'=>$user->id,'domain_id'=>$domain->id)) }}</h3>
                <h4>{{ count($domain->databases)."/".$domain->plan->num_databases }}</h4>            
            </div>
            <div class="col-sm-4">
                <a href="{{route('user.ftps.create',array('user_id'=>$user->id,'domain_id'=>$domain->id))}}">{{ HTML::image('img/ftp-icon.png')}}</a>
                <h3>{{ HTML::linkRoute('user.ftps.index',trans('frontend.link.ftp.index'),array('user_id'=>$user->id,'domain_id'=>$domain->id)) }}</h3>
                <h4>{{ count($domain->ftps)."/".$domain->plan->num_ftps }}</h4>            
            </div>
        </div>
    </div>
</div>
@stop
