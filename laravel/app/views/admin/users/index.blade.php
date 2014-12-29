@extends('layouts.master')

@section('contenido')
<div class="container">
      <div class="row">
            <ul class="nav nav-tabs" role="tablist">
                  <li>{{HTML::linkRoute('admin.domain_costs.index',trans('frontend.link.admin.domain_costs.index'))}}</li>
                  <li>{{HTML::linkRoute('admin.hosting_costs.index',trans('frontend.link.admin.hosting_costs.index'))}}</li>
                  <li>{{HTML::linkRoute('admin.free_domains.index',trans('frontend.link.admin.free_domains.index'))}}</li>
                  <li>{{HTML::linkRoute('admin.plans.index',trans('frontend.link.admin.plans.index'))}}</li>
                  <li>{{HTML::linkRoute('admin.servers.index',trans('frontend.link.admin.servers.index'))}}</li>

            </ul>
      </div>
      <div class="row">
            <div class="col-xs-12">
                  @if(count($users))
                  <div class="table-responsive">
                        <table class="table">
                              <tr>
                                    <th>{{trans('frontend.table_head.admin.user.id')}}</th>
                                    <th>{{trans('frontend.table_head.admin.user.name')}}</th>                    
                                    <th>{{trans('frontend.table_head.admin.user.created')}}</th>                        
                                    <th>{{trans('frontend.table_head.admin.user.destroy')}}</th>
                              </tr>
                              @foreach($users as $user)
                              <tr>                              
                                    <td>{{ HTML::linkRoute('user.domains.index',$user->email,array($user->id)) }}</td>
                                    <td>{{ $user->first_name.' '.$user->last_name}}</td>
                                    <td>{{ $user->created_at}}</td> 
                                    <td>
                                          {{ Form::open(array('route' => array('admin.users.destroy',$user->id),'method'=>'DELETE','id'=>$user->id,"class"=>'delete_domain')) }}
                                          {{ Form::button(trans('frontend.button.admin.user.destroy.submit'),array("class"=>'btn btn-danger',"onclick"=>"confirmDelete(".$user->id.")")) }}
                                          {{ Form::close() }}
                                    </td>
                              </tr>                    
                              @endforeach
                        </table>

                        {{ $users->links(); }}

                  </div>
                  @else
                  <h1>{{trans('frontend.messages.no_users')}}</h1>
                  @endif
            </div>
      </div>
</div>
@stop

@section('scripts')

@stop
