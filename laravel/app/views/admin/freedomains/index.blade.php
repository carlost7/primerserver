@extends('layouts.master')

@section('contenido')
<div class="container">
      <div class="row">
            <div class="col-xs-12">
                  <h1>{{ trans('frontend.title.admin.free_domains.index') }}</h1>
                  @if(count($freeDomains))
                  <div class="table-responsive">
                        <table class="table">
                              <tr>
                                    <th>{{ trans('frontend.table_head.admin.free_domains.domain') }}</th>
                                    <th>{{ trans('frontend.table_head.admin.free_domains.email') }}</th>
                                    <th>{{ trans('frontend.table_head.admin.free_domains.registry') }}</th>
                                    <th>{{ trans('frontend.table_head.admin.free_domains.active') }}</th>
                                    <th>{{ trans('frontend.table_head.admin.free_domains.edit') }}</th>
                                    <th>{{ trans('frontend.table_head.admin.free_domains.delete') }}</th>
                              </tr>
                              @foreach($freeDomains as $freeDomain)
                              <tr>
                                    <td>{{ $freeDomain->domain->domain }}</td>
                                    <td>{{ $freeDomain->user->email }}</td>
                                    <td>{{ $freeDomain->created_at }}</td>
                                    <td>{{ $freeDomain->active }}</td>
                                    <td>{{ HTML::linkRoute('admin.free_domains.edit',trans('frontend.link.admin.free_domains.edit'),array($freeDomain->id),array('class'=>'btn btn-primary')) }}</td>
                                    <td>
                                          {{ Form::open(array('route' => array('admin.free_domains.destroy',$freeDomain->id),'method'=>'DELETE','id'=>$freeDomain->id,"class"=>'delete_database')) }}
                                          {{ Form::button("Eliminar",array("class"=>'btn btn-danger')) }}
                                          {{ Form::close() }}
                                    </td>
                              </tr>
                              @endforeach
                        </table>
                        {{ $freeDomains->links(); }}
                  </div>
                  @else
                  <h1>{{"No hay costos de dominio"}}</h1>
                  @endif
            </div>
      </div>
</div>
@stop