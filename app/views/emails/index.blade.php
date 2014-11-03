@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <ul class="nav nav-tabs" role="tablist">
            <li>{{HTML::LinkRoute('user.domains.index',trans('frontend.link.domain.index'),array($user->id))}}</li>
            <li>{{HTML::LinkRoute('user.domains.show',$domain->domain,array($user->id,$domain->id))}}</li>
            <li>{{HTML::LinkRoute('user.emails.create',trans('frontend.link.email.create'),array($user->id,$domain->id))}}</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-xs-12">
            @if(count($emails))
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>{{trans('frontend.table_head.email.email')}}</th>                    
                        <th>{{trans('frontend.table_head.email.user_email')}}</th>
                        <th>{{trans('frontend.table_head.email.forward')}}</th>                        
                    </tr>
                    @foreach($emails as $email)
                    <tr>                              
                        <td>{{ HTML::linkRoute('user.emails.show',$email->email,array($user->id,$domain->id)) }}</td>
                        <td>{{ $email->user_email}}</td>
                        <td>{{ $email->forward}}</td>                         
                    </tr>                    
                    @endforeach
                </table>

                {{ $emails->links(); }}

            </div>
            @else
            <h1>{{trans('frontend.messages.no_emails')}}</h1>
            @endif
        </div>
    </div>
</div>
@stop