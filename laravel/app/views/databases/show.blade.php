@extends('layouts.master')

@section('contenido')
<div class="container">    
      <div class="row">        
            @include('layouts.menu', ['page' => 'databases'])
            <div class="col-md-8 sidebar contenido list-table">
                  <h2>{{ trans('frontend.title.database.show',array('database'=>$database->database)) }}</h2>
                  <h2>{{ $database->user_database }}</h2>
                  <h2>{{ $database->forward }}</h2>
                  <h2>{{ "Espacio disponible" }}</h2>            
            </div>
      </div>
</div>
@stop