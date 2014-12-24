@extends('layouts.master')

@section('contenido')
<div class="container">
      <div class="row">
            <ul class="nav nav-tabs" role="tablist">
                  <li>{{HTML::LinkRoute('admin.servers.index',trans('frontend.link.admin.servers.index'))}}</li>
            </ul>
      </div>
      <div class="row">
            <div class="col-sm-6 col-sm-push-3">
                  <h2>{{ trans('frontend.title.admin.servers.create') }}</h2>
                  <p>{{ trans('frontend.instruction.admin.servers.create') }}</p>


                  {{ Form::open(array('route' => array('admin.servers.store'))) }}

                  @include('layouts.show_form_errors')

                  <div class="form-group">
                        {{ Form::label('plan_id', trans("frontend.label.plan")) }}
                        {{ Form::select('plan_id',$plans,array('class'=>'form-control')) }}                        
                  </div>                  
                  <div class="form-group">
                        {{ Form::label('domain', trans("frontend.label.domain")) }}
                        {{ Form::text('domain',Input::old('domain'),array('placeholder' => trans("frontend.placeholder.domain"), 'class'=>'form-control'))}}
                  </div>
                  <div class="form-group">
                        {{ Form::label('nameserver', trans("frontend.label.nameserver")) }}
                        {{ Form::text('nameserver',Input::old('cost'),array('placeholder' => trans("frontend.placeholder.nameserver"), 'class'=>'form-control'))}}
                  </div>
                  <div class="form-group">
                        {{ Form::label('ip', trans("frontend.label.ip")) }}
                        {{ Form::text('ip',Input::old('concept'),array('placeholder' => trans("frontend.placeholder.ip"), 'class'=>'form-control'))}}
                  </div>                  
                  <div class="form-group">
                        {{Form::submit(trans("frontend.button.admin.servers.create.submit"),array('class'=>"btn btn-primary"))}}
                  </div>
                  {{ Form::close() }}
            </div>
      </div>
</div>
@stop
