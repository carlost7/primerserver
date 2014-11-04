@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <ul class="nav nav-tabs" role="tablist">
            <li>{{HTML::LinkRoute('user.domains.index',trans('frontend.link.domain.index'),array($user->id))}}</li>
            <li>{{HTML::LinkRoute('user.domains.show',$domain->domain,array($user->id,$domain->id))}}</li>
            <li>{{HTML::LinkRoute('user.ftps.create',trans('frontend.link.ftp.create'),array($user->id,$domain->id))}}</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-xs-12">
            @if(count($ftps))
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>{{trans('frontend.table_head.ftp.username')}}</th>
                        <th>{{trans('frontend.table_head.ftp.hostname')}}</th>                        
                        <th>{{trans('frontend.table_head.ftp.homedir')}}</th>                    
                        <th>{{trans('frontend.table_head.ftp.edit')}}</th>                        
                        <th>{{trans('frontend.table_head.ftp.delete')}}</th>                        
                    </tr>
                    @foreach($ftps as $ftp)
                    <tr>                              
                        <td>{{ HTML::linkRoute('user.ftps.show',$ftp->username,array($user->id,$domain->id,$ftp->id)) }}</td>
                        <td>{{ $ftp->hostname}}</td>
                        <td>{{ $ftp->homedir}}</td>                        
                        <td>{{ HTML::linkRoute('user.ftps.edit',trans('frontend.link.ftp.edit'),array($user->id,$domain->id,$ftp->id),array('class'=>'btn btn-primary')) }}</td>
                        <td>
                            {{ Form::open(array('route' => array('user.ftps.destroy',$user->id,$domain->id,$ftp->id),'method'=>'DELETE','id'=>$ftp->id,"class"=>'delete_ftp')) }}
                            {{ Form::submit(trans('frontend.button.ftp.destroy.submit'),array("class"=>'btn btn-danger',"onclick"=>"confirmDelete(".$ftp->id,")")) }}
                            {{ Form::close() }}
                        </td>                         
                    </tr>                    
                    @endforeach
                </table>

                {{ $ftps->links(); }}

            </div>
            @else
            <h1>{{trans('frontend.messages.no_ftps')}}</h1>
            @endif
        </div>
    </div>
</div>
@stop