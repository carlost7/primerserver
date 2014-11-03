@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <ul class="nav nav-tabs" role="tablist">
            <li>{{HTML::LinkRoute('user.domains.create',trans('frontend.link.domain.create'),$user->id)}}</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-xs-12">
            @if(count($domains))
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>{{trans('frontend.table_head.domain.domain')}}</th>
                        <th>{{trans('frontend.table_head.domain.active')}}</th>                    
                        <th>{{trans('frontend.table_head.domain.date_start')}}</th>
                        <th>{{trans('frontend.table_head.domain.date_end')}}</th>
                        <th>{{trans('frontend.table_head.domain.plan')}}</th>                        
                    </tr>
                    @foreach($domains as $domain)
                    <tr>                              
                        <td>{{ HTML::linkRoute('user.domains.show',$domain->domain,array($user->id,$domain->id)) }}</td>
                        <td>{{ $domain->active}}</td>
                        <td>{{ $domain->date_start}}</td> 
                        <td>{{ $domain->date_end}}</td>
                        <td>{{ $domain->plan->plan_name}}</td>                        
                    </tr>                    
                    @endforeach
                </table>

                {{ $domains->links(); }}

            </div>
            @else
            <h1>{{trans('frontend.messages.no_domains')}}</h1>
            @endif
        </div>
    </div>
</div>
@stop