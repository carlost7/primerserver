@extends('layouts.master')

@section('contenido')
<div class="container">
      <div class="row">
            <ul class="nav nav-tabs" role="tablist">
                  <li>{{HTML::LinkRoute('admin.domain_costs.index',trans('frontend.link.admin.domain_costs.index'))}}</li>
            </ul>
      </div>
      <div class="row">
            <div class="col-sm-6 col-sm-push-3">
                  <h2>{{ trans('frontend.title.admin.domain_costs.create') }}</h2>
                  <p>{{ trans('frontend.instruction.admin.domain_costs.create') }}</p>


                  {{ Form::open(array('route' => array('admin.domain_costs.store'))) }}

                  @include('layouts.show_form_errors')

                  <div class="form-group">
                        {{ Form::label('domain', trans("frontend.label.tld")) }}
                        {{ Form::text('domain',Input::old('domain'),array('placeholder' => trans("frontend.placeholder.tld"), 'class'=>'form-control'))}}
                  </div>
                  <div class="form-group">
                        {{ Form::label('cost', trans("frontend.label.cost")) }}
                        {{ Form::text('cost',Input::old('cost'),array('placeholder' => trans("frontend.placeholder.cost"), 'class'=>'form-control'))}}
                  </div>
                  <div class="form-group">
                        {{ Form::label('concept', trans("frontend.label.concept")) }}
                        {{ Form::text('concept',Input::old('concept'),array('placeholder' => trans("frontend.placeholder.concept"), 'class'=>'form-control'))}}
                  </div>
                  <div class="form-group">
                        {{ Form::label('currency', trans("frontend.label.currency")) }}
                        {{ Form::text('currency',Input::old('currency'),array('placeholder' => trans("frontend.placeholder.currency"), 'class'=>'form-control'))}}
                  </div>
                  <div class="form-group">
                        {{Form::submit(trans("frontend.button.admin.domain_costs.create.submit"),array('class'=>"btn btn-primary"))}}
                  </div>
                  {{ Form::close() }}
            </div>
      </div>
</div>
@stop
