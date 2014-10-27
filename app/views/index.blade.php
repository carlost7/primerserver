@extends('layouts.master')

@section('contenido')

<div class="container">

      <div class="row">
            <div class="col-sm-6">
                  <h1>Entrar</h1>
                  {{ Form::open(array('route' => 'session.store')) }}        
                  <div class="form-group">
                        {{ Form::label('email', 'Correo Electrónico') }}
                        {{ Form::text('email', Input::old('email'), array('placeholder' => 'ejemplo@correo.com', 'class'=>'form-control')) }}
                  </div>
                  <div class="form-group">
                        {{ Form::label('password', 'Password') }}
                        {{ Form::password('password',array('placeholder' => 'password', 'class'=>'form-control')) }}
                  </div> 
                  <div class="form-group">
                        <div class="checkbox">
                              <label>
                                    <input type="checkbox" name="rememberme" value="1"> Seguir conectado
                              </label>
                        </div>
                  </div>                  
                  @if (Session::has('login_errors'))
                  <div class="alert alert-danger">Correo o Password Incorrecto</div>
                  @endif                
                  <div class="form-group">
                        <button type="submit" class="btn btn-primary">Entrar</button>        
                        {{ HTML::linkAction('RemindersController@getRemind','Recuperar Password')}}
                  </div>                        
                  {{ Form::close() }}
            </div>
            <div class="col-sm-6">
                  <div class="text-center">
                        {{ HTML::LinkRoute('register.index','Registrarse',null,array('class'=>'btn btn-primary btn-lg')) }}                                          
                  </div>
            </div>            

      </div>

</div>

@stop