@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <ul class="nav nav-tabs" role="tablist">
              <li>{{HTML::LinkRoute('admin.hosting_costs.create',"agregar nuevo")}}</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-xs-12">
              <h1>{{ trans('frontend.title.admin.hosting_costs.index') }}</h1>
            @if(count($hostingCosts))
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>{{ trans('frontend.table_head.admin.hosting_costs.plan') }}</th>
                        <th>{{ trans('frontend.table_head.admin.hosting_costs.cost') }}</th>
                        <th>{{ trans('frontend.table_head.admin.hosting_costs.concept') }}</th>
                        <th>{{ trans('frontend.table_head.admin.hosting_costs.currency') }}</th>
                        <th>{{ trans('frontend.table_head.admin.hosting_costs.active') }}</th>                        
                        <th>{{ trans('frontend.table_head.admin.hosting_costs.edit') }}</th>
                        <th>{{ trans('frontend.table_head.admin.hosting_costs.delete') }}</th>
                    </tr>
                    @foreach($hostingCosts as $hostingCost)
                    <tr>
                        <td>{{ $hostingCost->plan->plan_name }}</td>
                        <td>{{ $hostingCost->cost }}</td>
                        <td>{{ $hostingCost->concept }}</td>
                        <td>{{ $hostingCost->currency }}</td>
                        <td>{{ ($hostingCost->active)?"si":"no" }}</td>
                        <td>{{ HTML::linkRoute('admin.hosting_costs.edit',trans('frontend.link.admin.hosting_costs.edit'),array($hostingCost->id),array('class'=>'btn btn-primary')) }}</td>
                        <td>
                            {{ Form::open(array('route' => array('admin.hosting_costs.destroy',$hostingCost->id),'method'=>'DELETE','id'=>$hostingCost->id,"class"=>'delete_database')) }}
                            {{ Form::button("Eliminar",array("class"=>'btn btn-danger',"onclick"=>"confirmDelete(".$hostingCost->id.")")) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            @else
            <h1>{{"No hay costos de hospedaje"}}</h1>
            @endif
        </div>
    </div>
</div>
@stop