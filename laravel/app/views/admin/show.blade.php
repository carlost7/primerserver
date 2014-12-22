@extends('layouts.master')

@section('contenido')
@include('layouts.show_form_errors')
<div class="container">
      <div class="row">
            <ul class="nav nav-tabs" role="tablist">
                  <li>{{HTML::LinkRoute('admin.account.edit',trans('frontend.link.user.edit'),array(Auth::user()->id))}}</li>            
            </ul>
      </div>
      <div class="row">
            <div class="col-xs-12">
                  <div class="form-group">
                        {{ Form::label('first_name', trans('frontend.label.first_name')) }}
                        {{ $user->first_name ." ". $user->last_name }}

                  </div>                  
                  <div class="form-group">
                        {{ Form::label('email', trans('frontend.label.email')) }}
                        {{ $user->email }}
                  </div>                    
                  <div class="form-group">                        
                        {{ Form::label('telephone', trans('frontend.label.telephone')) }}
                        {{ $user->telephone }}
                  </div>
                  <div class="form-group">
                        {{ Form::label('cellphone', trans('frontend.label.cellphone')) }}
                        {{ $user->cellphone }}
                  </div>
            </div>
      </div>
</div>
@stop