<tr id="{{$no_order."_detail"}}">
      <td colspan="6">
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
      </td>
</tr>