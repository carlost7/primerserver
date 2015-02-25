@extends('layouts.master')

@section('contenido')
@include('layouts.show_form_errors')
<div class="container ">
      <div class="row">
        
            @include('layouts.mainMenu', array('activo' => ''))
            

            <div class="col-md-8 sidebar contenido list-table">
                  @if(count($domains))
                  <div class="table-responsive">
                        <table class="table">
                              <tr>
                                    <th>{{trans('frontend.table_head.domain.domain')}}</th>
                                    <th>{{trans('frontend.table_head.domain.active')}}</th>                                            
                                    <th>{{trans('frontend.table_head.domain.plan')}}</th>                                                
                                    <th>{{trans('frontend.table_head.domain.date')}}</th>                                    
                                    <th>{{trans('frontend.table_head.domain.activate')}}</th>
                                    <th>{{trans('frontend.table_head.domain.delete')}}</th>
                              </tr>
                              @foreach($domains as $domain)
                              <tr>                              
                                    <td>{{ HTML::linkRoute('user.domains.show',$domain->domain,array($user->id,$domain->id)) }}</td>
                                    <!-- podriamos utilizar iconos -->
                                    <td>{{ ($domain->active)?"si":"no"}}</td>                                                            
                                    <td>{{ $domain->plan->plan_name}}</td>
                                    <td>{{ $domain->date_start . " - " . $domain->date_end}}</td>                                    
                                    @if(!$domain->active && $domain->plan->plan_name != "free")
                                    <td>
                                          {{ HTML::LinkRoute('user.payments.index',trans('frontend.button.domain.activate.submit'),$user->id,array("class"=>'btn btn-success'))}}                            
                                    </td>
                                    @else
                                    <td></td>
                                    @endif
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
                  
                        <h1 class=" msj col-md-6 col-md-offset-3">{{trans('frontend.messages.no_domains')}}</h1>
                 
                  @endif
            </div>
      </div> <!-- ./row -->
</div>

@stop
