@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
            
        @include('layouts.menu', ['page' => 'ftps'])   
            
        <div class="col-md-8 sidebar contenido list-table">
            <div class="text-center">
                <h2>{{ trans('frontend.title.ftp.show') }}</h2> 
                <ul class="list-group">
                    <li class="list-group-item">Usuario FTP: {{$ftp->username."@".$ftp->hostname}}</li>                
                    <li class="list-group-item">Servidor FTP: ftp.{{$ftp->domain->server->domain }}</li>
                    <li class="list-group-item">Puerto FTPS: 21 </li>
                </ul>
                <ol class="breadcrumb">
                    <li>{{HTML::linkRoute("user.ftps.config.show",trans('frontend.button.ftp.show.filezilla'),array($user->id,$domain->id,$ftp->id,'filezilla'),array('class'=>"btn btn-primary"))}}</li>                    
                    <li>{{HTML::linkRoute("user.ftps.config.show",trans('frontend.button.ftp.show.cyberduck'),array($user->id,$domain->id,$ftp->id,'cyberduck'),array('class'=>"btn btn-primary"))}}</li>                    
                    <li>{{HTML::linkRoute("user.ftps.config.show",trans('frontend.button.ftp.show.coreftp'),array($user->id,$domain->id,$ftp->id,'coreftp'),array('class'=>"btn btn-primary"))}}</li>                    
                </ol>
            </div>
        </div>
    </div>    
</div>
@stop