@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <ul class="nav nav-tabs" role="tablist">
            <li>{{HTML::LinkRoute('user.domains.index',trans('frontend.link.domain.index'),array($user->id))}}</li>
            <li>{{HTML::LinkRoute('user.domains.show',$domain->domain,array($user->id,$domain->id))}}</li>
            <li>{{HTML::LinkRoute('user.databases.create',trans('frontend.link.database.create'),array($user->id,$domain->id))}}</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-xs-12">
            @if(count($databases))
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>{{trans('frontend.table_head.database.name_db')}}</th>                    
                        <th>{{trans('frontend.table_head.database.user')}}</th>                    
                        <th>{{trans('frontend.table_head.database.edit')}}</th>                        
                        <th>{{trans('frontend.table_head.database.delete')}}</th>                        
                    </tr>
                    @foreach($databases as $database)
                    <tr>                              
                        <td>{{ HTML::linkRoute('user.databases.show',$database->name_db,array($user->id,$domain->id,$database->id)) }}</td>
                        <td>{{ $database->user}}</td>
                        <td>{{ HTML::linkRoute('user.databases.edit',trans('frontend.link.database.edit'),array($user->id,$domain->id,$database->id),array('class'=>'btn btn-primary')) }}</td>
                        <td>
                            {{ Form::open(array('route' => array('user.databases.destroy',$user->id,$domain->id,$database->id),'method'=>'DELETE','id'=>$database->id,"class"=>'delete_database')) }}
                            {{ Form::submit(trans('frontend.button.database.destroy.submit'),array("class"=>'btn btn-danger',"onclick"=>"confirmDelete(".$database->id,")")) }}
                            {{ Form::close() }}
                        </td>                         
                    </tr>                    
                    @endforeach
                </table>

                {{ $databases->links(); }}

            </div>
            @else
            <h1>{{trans('frontend.messages.no_databases')}}</h1>
            @endif
        </div>
    </div>
</div>
@stop