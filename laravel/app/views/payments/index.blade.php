@extends('layouts.master')

@section('contenido')
<div class="container">
      <div class="row">
            <ul class="nav nav-tabs" role="tablist">
                  <li>{{HTML::LinkRoute('user.show',trans('frontend.link.domain.index'),$user->id)}}</li>
            </ul>
      </div>
      {{ Form::open(array("route" => array('user.payments.update',$user->id),"method"=>'PUT')) }}                                          
      <div class="row">
            <div class="col-xs-7 pull-right">                  
                  <div class="col-sm-4">
                        {{ Form::button(trans('frontend.button.payment.select_all'),array("class"=>'btn btn-warning','onclick'=>'select_all()')) }}
                  </div>
                  <div class="col-sm-4">
                        {{ trans('frontend.label.number_payments') }}<span id="number_payments">0</span>
                  </div>
                  <div class="col-sm-4">
                        {{ Form::submit(trans('frontend.button.payment.pay_many'),array("class"=>'btn btn-success')) }}
                  </div>
            </div>
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
                              </tr>
                              @foreach($payments as $payment)
                              <tr id="{{$payment->no_order}}">
                                    <td  onclick="toggle_table({{"'".$payment->no_order."','".$user->id."'"}})">{{$payment->no_order}} <span class="caret"></span></td>
                                    <td>{{ $payment->domain->domain }}</td>
                                    <td>{{ '$'.$payment->ammount }}</td>
                                    <td>{{ $payment->currency}}</td>
                                    <td>{{ $payment->status}}</td>
                                    <td>
                                          {{ Form::checkbox('no_order[]',$payment->no_order,false,array(($payment->status=="approved")?'disabled':'','class'=>'checkbox_payment','onclick'=>"select_payment(this)")) }}
                                    </td>
                              </tr>
                              @endforeach
                        </table>                        
                  </div>
                  @else
                  <h1>{{trans('frontend.messages.no_payments')}}</h1>
                  @endif
            </div>
      </div>
                                          {{ Form::close()}}
</div>
@stop

@section('scripts')
<script>
      var num_registries = 0;
      var toggle_select_all = false;
              
      function toggle_table(no_order, id){
            if ($("#" + no_order + "_detail").length){
              if ($("#" + no_order + "_detail").hasClass("mostrar")){
                  $("#" + no_order + "_detail").removeClass("mostrar");
                  $("#" + no_order + "_detail").hide();
              }else{
                  $("#" + no_order + "_detail").show();
                  $("#" + no_order + "_detail").addClass("mostrar");
              }
            } else{
              get_details(no_order, id);
              result = $("#" + no_order + "_detail");
            }
      }

      function get_details(no_order, id) {
            $.ajax({
            url: base_url + "/user/payments/" + id + "/" + no_order,
            type: "POST",
            success: function(data, textStatus, jqXHR) {
                  $(data['resultado']).insertAfter("#" + no_order);                      
            }
            });
      }
      
      function select_payment(e){
            if($(e).is(':checked')){
                  num_registries = num_registries+1;                                    
            }else{
                  num_registries = num_registries-1;                  
            }            
            $("#number_payments").text(num_registries);
      }
      
      function select_all(){            
            var registries = $(".checkbox_payment:enabled");
            if(!toggle_select_all){
                  toggle_select_all = true;                  
                  registries.prop('checked',true);
                  num_registries = registries.length;
            }else{
                  toggle_select_all = false;                  
                  registries.prop('checked',false);
                  num_registries = 0;
                  
            }
            $("#number_payments").text(num_registries);            
      }

</script>
@stop