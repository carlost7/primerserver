@extends('layouts.master')

@section('contenido')
<div class="container">
      <div class="row">
            <ul class="nav nav-tabs" role="tablist">
                  <li>{{HTML::LinkRoute('admin.plans.index',trans('frontend.link.admin.plans.index'))}}</li>
            </ul>
      </div>
      <div class="row">
            <div class="col-sm-6 col-sm-push-3">
                  <h2>{{ trans('frontend.title.admin.plans.create') }}</h2>
                  <p>{{ trans('frontend.instruction.admin.plans.create') }}</p>


                  {{ Form::open(array('route' => array('admin.plans.store'))) }}

                  @include('layouts.show_form_errors')

                  <div class="form-group">
                        {{ Form::label('plan_name', trans("frontend.label.plan_name")) }}
                        {{ Form::text('plan_name',Input::old('domain'),array('placeholder' => trans("frontend.placeholder.plan_name"), 'class'=>'form-control'))}}
                  </div>
                  <div class="form-group">
                        {{ Form::label('num_emails', trans("frontend.label.num_emails")) }}
                        {{ Form::text('num_emails',Input::old('cost'),array('placeholder' => trans("frontend.placeholder.num_emails"), 'class'=>'form-control'))}}
                  </div>
                  <div class="form-group">
                        {{ Form::label('num_databases', trans("frontend.label.num_databases")) }}
                        {{ Form::text('num_databases',Input::old('concept'),array('placeholder' => trans("frontend.placeholder.num_databases"), 'class'=>'form-control'))}}
                  </div>
                  <div class="form-group">
                        {{ Form::label('num_ftps', trans("frontend.label.num_ftps")) }}
                        {{ Form::text('num_ftps',Input::old('currency'),array('placeholder' => trans("frontend.placeholder.num_ftps"), 'class'=>'form-control'))}}
                  </div>
                  <div class="form-group">
                        {{ Form::label('quota_emails', trans("frontend.label.quota_emails")) }}
                        {{ Form::text('quota_emails',Input::old('cost'),array('placeholder' => trans("frontend.placeholder.quota_emails"), 'class'=>'form-control'))}}
                  </div>
                  <div class="form-group">
                        {{ Form::label('quota_databases', trans("frontend.label.quota_databases")) }}
                        {{ Form::text('quota_databases',Input::old('concept'),array('placeholder' => trans("frontend.placeholder.quota_databases"), 'class'=>'form-control'))}}
                  </div>
                  <div class="form-group">
                        {{ Form::label('quota_ftps', trans("frontend.label.quota_ftps")) }}
                        {{ Form::text('quota_ftps',Input::old('currency'),array('placeholder' => trans("frontend.placeholder.quota_ftps"), 'class'=>'form-control'))}}
                  </div>
                  <div class="form-group">
                        {{Form::submit(trans("frontend.button.admin.plans.create.submit"),array('class'=>"btn btn-primary"))}}
                  </div>
                  {{ Form::close() }}
            </div>
      </div>
</div>
@stop
