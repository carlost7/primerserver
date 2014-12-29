@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <ul class="nav nav-tabs" role="tablist">
              <li>{{HTML::LinkRoute('admin.plans.create',"agregar nuevo")}}</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-xs-12">
              <h1>{{ trans('frontend.title.admin.plans.index') }}</h1>
            @if(count($plans))
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>{{ trans('frontend.table_head.admin.plans.name') }}</th>
                        <th>{{ trans('frontend.table_head.admin.plans.num_emails') }}</th>
                        <th>{{ trans('frontend.table_head.admin.plans.num_databases') }}</th>
                        <th>{{ trans('frontend.table_head.admin.plans.num_ftps') }}</th>
                        <th>{{ trans('frontend.table_head.admin.plans.quota_emails') }}</th>
                        <th>{{ trans('frontend.table_head.admin.plans.quota_databases') }}</th>
                        <th>{{ trans('frontend.table_head.admin.plans.quota_ftps') }}</th>                        
                        <th>{{ trans('frontend.table_head.admin.plans.edit') }}</th>
                        <th>{{ trans('frontend.table_head.admin.plans.delete') }}</th>
                    </tr>
                    @foreach($plans as $plan)
                    <tr>
                        <td>{{ $plan->plan_name }}</td>
                        <td>{{ $plan->num_emails }}</td>
                        <td>{{ $plan->num_databases }}</td>
                        <td>{{ $plan->num_ftps }}</td>
                        <td>{{ $plan->quota_emails }}</td>
                        <td>{{ $plan->quota_databases }}</td>
                        <td>{{ $plan->quota_ftps }}</td>                        
                        <td>{{ HTML::linkRoute('admin.plans.edit',trans('frontend.link.admin.plans.edit'),array($plan->id),array('class'=>'btn btn-primary')) }}</td>
                        <td>
                            {{ Form::open(array('route' => array('admin.plans.destroy',$plan->id),'method'=>'DELETE','id'=>$plan->id,"class"=>'delete_database')) }}
                            {{ Form::button("Eliminar",array("class"=>'btn btn-danger',"onclick"=>"confirmDelete(".$plan->id.")")) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            @else
            <h1>{{"No hay planes"}}</h1>
            @endif
        </div>
    </div>
</div>
@stop