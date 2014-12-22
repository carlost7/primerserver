@extends('layouts.master')

@section('contenido')
<div class="container">
      <div class="row">
            <ul class="nav nav-tabs" role="tablist">            
            </ul>
      </div>
      <div class="row">
            <div class="col-sm-6 col-sm-push-3">
                  <h2>Editar costo de dominio</h2>

                  {{ Form::model($domainCost,array("route" => array('admin.domain_costs.update',$domainCost->id),"method"=>'PUT')) }}

                  @include('layouts.show_form_errors')
                  <div class="form-group">
                        {{ Form::label('domain', "TLD") }}
                        {{ Form::text('domain',Input::old('domain'),array('placeholder' => "tld", 'class'=>'form-control'))}}

                  </div>
                  <div class="form-group">
                        {{ Form::label('cost', "Costo") }}
                        {{ Form::text('cost',Input::old('cost'),array('placeholder' => "costo", 'class'=>'form-control'))}}
                  </div>
                  <div class="form-group">
                        {{ Form::label('concept', "Concept") }}
                        {{ Form::text('concept',Input::old('concept'),array('placeholder' => "concepto", 'class'=>'form-control'))}}
                  </div>
                  <div class="form-group">
                        {{ Form::label('currency', "Moneda") }}
                        {{ Form::text('currency',Input::old('currency'),array('placeholder' => "moneda", 'class'=>'form-control'))}}
                  </div>
                  <div class="form-group">
                        {{Form::submit("Actualizar",array('class'=>"btn btn-primary"))}}                        
                  </div>
                  {{ Form::close() }}
            </div>
      </div>
</div>
@stop
