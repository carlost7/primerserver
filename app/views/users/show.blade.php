@extends('layouts.master')

@section('contenido')
@include('layouts.show_form_errors')
<div class="container">
    <div class="row">
        <ul class="nav nav-tabs" role="tablist">
            <li>{{HTML::LinkRoute('user.edit',trans('frontend.link.user_edit'),array(Auth::user()->id))}}</li>
            <li>{{HTML::LinkRoute('user.domains.create',trans('frontend.link.domain_create'),$user->id)}}</li>                  
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
                        <th>{{trans('frontend.table_head.domain.delete')}}</th> 
                        <th>{{trans('frontend.table_head.domain.activate')}}</th>
                        
                    </tr>
                    @foreach($domains as $domain)
                    <tr>                              
                        <td>{{ HTML::linkRoute('user.domains.show',$domain->domain,array($user->id,$domain->id)) }}</td>
                        <td>{{ $domain->active}}</td>                                    
                        <td>{{ $domain->date_start}}</td>
                        <td>{{ $domain->date_end}}</td>
                        <td>{{ $domain->plan->plan_name}}</td>
                        <td>
                            {{ Form::open(array('route' => array('user.domains.destroy',$user->id,$domain->id),'method'=>'DELETE','id'=>$domain->id,"class"=>'delete_domain')) }}
                            {{ Form::button(trans('frontend.button.domain.destroy.submit'),array("class"=>'btn btn-danger',"onclick"=>"confirmDelete(".$domain->id.")")) }}
                            {{ Form::close() }}
                        </td> 
                        @if(!$domain->active)
                        <td>
                            {{ Form::open(array("route" => array('user.domains.update',$user->id,$domain->id),"method"=>'PUT')) }}
                            {{ Form::submit(trans('Activar'),array("class"=>'btn btn-success')) }}
                            {{Form::close()}}
                        </td>
                        @else
                        <td></td>
                        @endif

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