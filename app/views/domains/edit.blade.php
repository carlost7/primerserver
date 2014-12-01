@extends('layouts.master')

@section('contenido')
<div class="container">
      <div class="row">
            <ul class="nav nav-tabs" role="tablist">
                  <li>{{HTML::LinkRoute('user.domains.index',trans('frontend.link.domain.index'),$user->id)}}</li>                  
            </ul>
      </div>
      <div class="row">
            <div class="col-sm-6 col-sm-push-3">
                  <h2>{{ trans('frontend.title.domain.edit') }}</h2>

                  <div class="instrucciones">
                        <p>{{trans('frontend.instruction.domain.edit')}}</p>
                  </div>

                  {{ Form::model($domain,array("route" => array('user.domains.update',$user->id,$domain->id),"method"=>'PUT')) }}

                  @include('layouts.show_form_errors')

                  <div class="form-group" id="domain-combo">                        
                        {{ Form::label('domain', trans('frontend.label.domain')) }}
                        <div class="input-group">
                              {{ Form::text('domain', Input::old('domain'), array('placeholder' => trans('frontend.placeholder.domain'), 'class'=>'form-control', 'id'=>'domain')) }}
                              <div class="input-group-addon hidden" id="domain-cost-addon">
                                    <div id="domain-cost" class="domain-cost"></div>                                    
                              </div>
                              <div class="input-group-btn">
                                    {{ Form::button(trans('frontend.button.domain_options.confirm'),array('class'=>"btn btn-primary",'onclick'=>'check_domain()')) }}
                              </div>
                        </div>
                        <div id="domain-message" class="hidden"></div>
                        <div class="list-group hidden" id="domain-options" ></div>

                  </div>                  
                  <div class="form-group">
                        {{Form::submit(trans('frontend.button.domain.store.submit'),array('class'=>"btn btn-primary", "id" => "submit-domain", "disabled"=>"disabled"))}}
                  </div>        
                  {{ Form::close() }}
            </div>
      </div>
</div>
@include('layouts.modal_password')
@stop

@section('scripts')
{{HTML::script("js/check_domains.js")}}
@stop