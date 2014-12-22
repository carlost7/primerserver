@extends('layouts.master')

@section('contenido')
<div class="container">
      <div class="row">
            <ul class="nav nav-tabs" role="tablist">

            </ul>
      </div>
      <div class="row">
            <div class="col-sm-6 col-sm-push-3">
                  <h2>Costos de dominio</h2>

                  <div class="instrucciones">
                        <p>Crear nuevo costo de dominio</p>
                  </div>

                  {{ Form::open(array('route' => array('admin.domain_costs.store'))) }}

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
                        {{Form::submit("Crear",array('class'=>"btn btn-primary"))}}                        
                  </div>
                  {{ Form::close() }}
            </div>
      </div>
</div>
@stop
