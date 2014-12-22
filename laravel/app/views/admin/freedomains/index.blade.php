@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <ul class="nav nav-tabs" role="tablist">
              <li>{{HTML::LinkRoute('admin.domain_costs.create',"agregar nuevo")}}</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-xs-12">
              <h1>{{ trans('frontend.title.admin.domain_costs.index') }}</h1>
            @if(count($domainCosts))
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>{{ trans('frontend.table_head.admin.domain_costs.domain') }}</th>
                        <th>{{ trans('frontend.table_head.admin.domain_costs.cost') }}</th>
                        <th>{{ trans('frontend.table_head.admin.domain_costs.concept') }}</th>
                        <th>{{ trans('frontend.table_head.admin.domain_costs.currency') }}</th>
                        <th>{{ trans('frontend.table_head.admin.domain_costs.edit') }}</th>
                        <th>{{ trans('frontend.table_head.admin.domain_costs.delete') }}</th>
                    </tr>
                    @foreach($domainCosts as $domainCost)
                    <tr>
                        <td>{{ $domainCost->domain }}</td>
                        <td>{{ $domainCost->cost }}</td>
                        <td>{{ $domainCost->concept }}</td>
                        <td>{{ $domainCost->currency }}</td>
                        <td>{{ HTML::linkRoute('admin.domain_costs.edit',trans('frontend.link.admin.domain_costs.edit'),array($domainCost->id),array('class'=>'btn btn-primary')) }}</td>
                        <td>
                            {{ Form::open(array('route' => array('admin.domain_costs.destroy',$domainCost->id),'method'=>'DELETE','id'=>$domainCost->id,"class"=>'delete_database')) }}
                            {{ Form::button("Eliminar",array("class"=>'btn btn-danger')) }}
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