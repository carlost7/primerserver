@extends('layouts.master')

@section('contenido')
<div class="container">
      <div class="row">
            <ul class="nav nav-tabs" role="tablist">
                  <li>{{HTML::LinkRoute('user.domains.index',trans('frontend.link.domain.index'),$user->id)}}</li>
            </ul>
      </div>
      <div class="row">
            <div class="col-xs-12">
                  @if(count($payments))
                  <div class="table-responsive">
                        <table class="table">
                              <tr>
                                    <th>{{trans('frontend.table_head.payment.ammount')}}</th>
                                    <th>{{trans('frontend.table_head.payment.currency')}}</th>
                                    <th>{{trans('frontend.table_head.payment.description')}}</th>                    
                                    <th>{{trans('frontend.table_head.payment.date_start')}}</th>
                                    <th>{{trans('frontend.table_head.payment.dateemd')}}</th>
                                    <th>{{trans('frontend.table_head.payment.no_order')}}</th>                        
                                    <th>{{trans('frontend.table_head.payment.pay')}}</th>                                    
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
                              </tr>                    
                              @endforeach
                        </table>

                        {{ $domains->links(); }}

                  </div>
                  @else
                  <h1>{{trans('frontend.messages.no_payments')}}</h1>
                  @endif
            </div>
      </div>
</div>
@stop