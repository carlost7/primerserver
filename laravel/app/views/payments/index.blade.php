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
                  <div class="table-aresponsive">
                        <table class="table">
                              <tr>
                                    <th>{{trans('frontend.table_head.payment.no_order')}}</th>                        
                                    <th>{{trans('frontend.table_head.payment.domain')}}</th>                        
                                    <th>{{trans('frontend.table_head.payment.ammount')}}</th>
                                    <th>{{trans('frontend.table_head.payment.currency')}}</th>                                    
                                    <th>{{trans('frontend.table_head.payment.status')}}</th>                        
                                    <th>{{trans('frontend.table_head.payment.pay')}}</th>                                    
                              </tr>
                              @foreach($payments as $payment)
                              <tr>                              
                                    <td>{{ HTML::linkRoute('user.payments.show',$payment->no_order,array($user->id,$payment->no_order))}}</td>                                    
                                    <td>{{ $payment->domain->domain }}</td>
                                    <td>{{ '$'.$payment->ammount }}</td>
                                    <td>{{ $payment->currency}}</td> 
                                    <td>{{ $payment->status}}</td>
                                    @if($payment->status!="approved")
                                    <td>
                                          {{ Form::open(array("route" => array('user.payments.update',$user->id,$payment->no_order),"method"=>'PUT')) }}
                                          {{ Form::submit(trans('frontend.button.payment.update.submit'),array("class"=>'btn btn-success')) }}
                                          {{ Form::close()}}
                                    </td>
                                    @else
                                    <td></td>
                                    @endif

                              </tr>                    
                              @endforeach
                        </table>

                        {{ $payments->links(); }}

                  </div>
                  @else
                  <h1>{{trans('frontend.messages.no_payments')}}</h1>
                  @endif
            </div>
      </div>
</div>
@stop