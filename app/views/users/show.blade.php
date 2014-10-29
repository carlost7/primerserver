@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <ul class="nav nav-tabs" role="tablist">
            <li>{{HTML::LinkRoute('user.edit',trans('frontend.link.user_edit'),array(Auth::user()->id))}}</li>
            <li>{{HTML::LinkRoute('user.domains.{user_id}.create',trans('frontend.link.domain_create'),$user->id)}}
            <li><a href="#">Pagos</a></li>
            <li><a href="#">Mensajes</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-xs-12">
            @if(count($user->domains))
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>{{trans('frontend.table_domains.domain')}}</th>
                        <th>{{trans('frontend.table_domains.active')}}</th>                    
                        <th>{{trans('frontend.table_domains.date_start')}}</th>
                        <th>{{trans('frontend.table_domains.date_end')}}</th>
                        <th>{{trans('frontend.table_domains.plan')}}</th>                        
                    </tr>
                    @foreach($domains as $domain)
                    <tr>                              
                        <td>{{ $domains->domain }}</td>
                        <td>{{ $domains->active}}</td>
                        <td>{{ $domains->date_start}}</td> 
                        <td>{{ $domains->date-end}}</td>
                        <td>{{ $domains->plan->plan_name}}</td>                        
                    </tr>                    
                    @endforeach
                </table>

                {{ $domains->links(); }}                

            </div>
            @else
            <h1>{{trans('frontend.no_domains')}}</h1>
            @endif
        </div>
    </div>
</div>
@stop