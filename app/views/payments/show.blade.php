@extends('layouts.master')

@section('contenido')
<div class="container">
      <div class="row">
            <ul class="nav nav-tabs" role="tablist">                  
                  <li>{{HTML::LinkRoute('user.domains.index',trans('frontend.link.domain.index'),$user->id)}}</li>
                  <li><a href="{{URL::route('user.payments.index',$user->id)}}">{{trans('frontend.link.payment.index')}}</a></li>                  
            </ul>
      </div>
      <div class="row">
            <div class="col-xs-12">
                  @if(count($payments))
                  <div class="table-responsive">
                        <table class="table">
                              <tr>
                                    <th>{{trans('frontend.table_head.payment.no_order')}}</th>                        
                                    <th>{{trans('frontend.table_head.payment.ammount')}}</th>
                                    <th>{{trans('frontend.table_head.payment.currency')}}</th>
                                    <th>{{trans('frontend.table_head.payment.concept')}}</th>                    
                                    <th>{{trans('frontend.table_head.payment.description')}}</th>                    
                                    <th>{{trans('frontend.table_head.payment.date_start')}}</th>                                                                        
                              </tr>
                              @foreach($payments as $payment)
                              <tr>                              
                                    <td>{{ $payment->no_order}}</td>                        
                                    <td>{{ $payment->ammount }}</td>
                                    <td>{{ $payment->currency}}</td>
                                    <td>{{ $payment->concept}}</td>                    
                                    <td>{{ $payment->description}}</td>                    
                                    <td>{{ $payment->date_start}}</td>


                              </tr>                    
                              @endforeach
                        </table>
                  </div>
                  @else
                  <h1>{{trans('frontend.messages.no_payments')}}</h1>
                  @endif
            </div>
      </div>
      @if($payment->status!="approved")
      <div class="row">
            <div class="col-xs-1 col-xs-push-5">
                  {{ Form::open(array("route" => array('user.payments.update',$user->id,$payment->no_order),"method"=>'PUT')) }}
                  {{ Form::submit(trans('frontend.button.payment.update.submit'),array("class"=>'btn btn-success')) }}
                  {{ Form::close()}}
            </div>
      </div>
      @endif
</div>
@stop