@extends('layouts.master')

@section('contenido')
<div class="container">
      
      <div class="row">
          
          @include('layouts.mainMenu', array('activo' => 'dominio'))
          
            <div class="col-md-8 sidebar contenido list-table">
                <div class="col-md-10 col-md-offset-1">
                  <h2><!-- {{ trans('frontend.title.domain.create') }} --></h2>

                  <div class="instrucciones">
                       <!-- <p>{{trans('frontend.instruction.domain.create')}}</p> -->
                  </div>

                  {{ Form::open(array('route' => array('user.domains.store',$user->id))) }}

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
                        {{ Form::label('plan_id', trans('frontend.label.plans')) }}
                        {{ Form::select('plan_id',$plans,Input::old('plans'))}}
                  </div>
                  <div class="form-group">
                        {{ Form::label('password', trans('frontend.label.password')) }}
                        <div class="input-group">
                              {{ Form::password('password',array('placeholder' => trans('frontend.placeholder.password'), 'class'=>'form-control', 'id'=>'password')) }}
                              <span class="input-group-btn">
                                    {{ Form::button(trans('frontend.button.modal_password.generate_new'),array('class'=>"btn btn-primary",'data-target'=>"#ModalPassword",'onclick'=>'get_password()','data-toggle'=>"modal")) }}                        
                              </span>                  
                        </div>
                  </div>
                  <div class="form-group">
                        {{ Form::label('password_confirmation', trans('frontend.label.password_confirmation')) }}
                        {{ Form::password('password_confirmation',array('placeholder' => trans('frontend.placeholder.password_confirmation'), 'class'=>'form-control', 'id' => 'password_confirmation')) }}
                  </div>                        
                  <div class="form-group">
                        {{Form::submit(trans('frontend.button.domain.store.submit'),array('class'=>"btn btn-primary", "id" => "submit-domain", "disabled"=>"disabled"))}}
                  </div>        
                  {{ Form::close() }}
            </div>
            </div><!-- ./col-md-8 -->
      </div>
</div>
@include('layouts.modal_password')
@stop

@section('scripts')
{{HTML::script("js/check_domains.js")}}
@stop