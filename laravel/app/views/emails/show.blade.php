@extends('layouts.master')

@section('contenido')
<div class="container">    
      <div class="row">
            @include('layouts.menu', ['page' => 'emails'])
            <div class="col-md-8 sidebar contenido list-table">
                  <h2>{{ trans('frontend.title.email.show',array('email'=>$email->email)) }}</h2>
                  <h2>{{ $email->user_email }}</h2>
                  <h2>{{ $email->forward }}</h2>
                  <h2>{{ "Espacio disponible" }}</h2>            
            </div>
      </div>
</div>
@stop