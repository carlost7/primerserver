@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <ul class="nav nav-tabs" role="tablist">
              <li>{{HTML::LinkRoute('admin.servers.create',"agregar nuevo")}}</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-xs-12">
              <h1>{{ trans('frontend.title.admin.servers.index') }}</h1>
            @if(count($servers))
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>{{ trans('frontend.table_head.admin.servers.domain') }}</th>
                        <th>{{ trans('frontend.table_head.admin.servers.nameserver') }}</th>
                        <th>{{ trans('frontend.table_head.admin.servers.ip') }}</th>
                        <th>{{ trans('frontend.table_head.admin.servers.plan') }}</th>
                        <th>{{ trans('frontend.table_head.admin.servers.edit') }}</th>
                        <th>{{ trans('frontend.table_head.admin.servers.delete') }}</th>
                    </tr>
                    @foreach($servers as $server)
                    <tr>
                        <td>{{ $server->domain }}</td>
                        <td>{{ $server->nameserver }}</td>
                        <td>{{ $server->ip }}</td>
                        <td>{{ $server->plan->plan_name }}</td>
                        <td>{{ HTML::linkRoute('admin.servers.edit',trans('frontend.link.admin.servers.edit'),array($server->id),array('class'=>'btn btn-primary')) }}</td>
                        <td>
                            {{ Form::open(array('route' => array('admin.servers.destroy',$server->id),'method'=>'DELETE','id'=>$server->id,"class"=>'delete_database')) }}
                            {{ Form::button("Eliminar",array("class"=>'btn btn-danger',"onclick"=>"confirmDelete(".$server->id.")")) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            @else
            <h1>{{"No hay costos de dominio"}}</h1>
            @endif
        </div>
    </div>
</div>
@stop