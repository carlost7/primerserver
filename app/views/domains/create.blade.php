@extends('layouts.master')

@section('contenido')
<div class="container">
      <div class="row">
            <ul class="nav nav-tabs" role="tablist">
                  <li>{{HTML::LinkRoute('user.domains.index',trans('frontend.link.domain_index'),$user->id)}}</li>                  
            </ul>
      </div>
      <div class="row">
            <div class="col-sm-6 col-sm-push-3">
                  <h2>{{ trans('frontend.domains.create.title') }}</h2>

                  <div class="instrucciones">
                        <p>{{trans('frontend.domains.create.instructions')}}</p>
                  </div>

                  {{ Form::open(array('route' => array('user.domains.store',$user->id))) }}

                  @include('layouts.show_form_errors')

                  <div class="form-group">                        
                        {{ Form::label('domain', trans('frontend.label_domain')) }}
                        {{ Form::text('domain', Input::old('domain'), array('placeholder' => trans('frontend.placeholder_domain'), 'class'=>'form-control')) }}                                          
                  </div>
                  <div class="form-group">
                        {{ Form::label('plan_id', trans('frontend.label_plans')) }}
                        {{ Form::select('plan_id',$plans,Input::old('plans'))}}
                  </div>
                  <div class="form-group">
                        {{Form::submit(trans('frontend.domains.create.submit'),array('class'=>"btn btn-primary"))}}                        
                  </div>        
                  {{ Form::close() }}
            </div>
      </div>
</div>
@stop