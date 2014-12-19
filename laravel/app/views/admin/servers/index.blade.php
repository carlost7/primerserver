@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <ul class="nav nav-tabs" role="tablist">
              <li>{{HTML::LinkRoute('administrador.domain_costs.create',"agregar nuevo")}}</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-xs-12">
            @if(count($domainCosts))
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>{{"Dominio"}}</th>                    
                        <th>{{"Costo"}}</th>                    
                        <th>{{"Cocepto"}}</th>                        
                        <th>{{"Moneda"}}</th>          
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                    @foreach($domainCosts as $domainCost)
                    <tr>                              
                        <td>{{ HTML::linkRoute('administrador.domain_costs.show',$domainCost->domain,array($domainCost->id)) }}</td>
                        <td>{{ $domainCost->cost}}</td>
                        <td>{{ $domainCost->concept}}</td>
                        <td>{{ $domainCost->currency}}</td>                        
                        <td>{{ HTML::linkRoute('administrador.domain_costs.edit',"editar",array($domainCost->id),array('class'=>'btn btn-primary')) }}</td>
                        <td>
                            {{ Form::open(array('route' => array('administrador.domain_costs.destroy',$domainCost->id),'method'=>'DELETE','id'=>$domainCost->id,"class"=>'delete_database')) }}
                            {{ Form::button("Eliminar",array("class"=>'btn btn-danger')) }}
                            {{ Form::close() }}
                        </td>                         
                    </tr>                    
                    @endforeach
                </table>
            </div>
            @else
            <h1>{{"No hay costos de dominio"}}</h1>
            @endif
        </div>
    </div>
</div>
@stop