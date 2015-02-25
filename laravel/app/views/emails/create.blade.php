@extends('layouts.master')

@section('contenido')
<div class="container">
      <div class="row">
            @include('layouts.menu', ['page' => 'emails'])
            <div class="col-md-8 sidebar contenido list-table">
                  <h2>{{ trans('frontend.title.email.create') }}</h2>

                  <div class="instrucciones">
                        <p>{{trans('frontend.instruction.email.create')}}</p>
                  </div>

                  {{ Form::open(array('route' => array('user.emails.store',$user->id,$domain->id))) }}

                  @include('layouts.show_form_errors')

                  <div class="form-group">
                        {{ Form::label('user_email', trans('frontend.label.user_email')) }}
                        {{ Form::text('user_email',Input::old('user_email'),array('placeholder' => trans('frontend.placeholder.user_email'), 'class'=>'form-control'))}}
                  </div>
                  <div class="form-group">                        
                        {{ Form::label('email', trans('frontend.label.email')) }}
                        <div class="input-group">
                              {{ Form::text('email', Input::old('email'), array('placeholder' => trans('frontend.placeholder.email'), 'class'=>'form-control')) }}
                              <span class="input-group-addon">{{ '@'.$domain->domain }}</span>
                        </div>
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

                  <div class="form-group forwarders">
                        {{ Form::label('forward', trans('frontend.label.forward')) }}

                        @if(count(Input::old()))
                        @foreach(Input::old('forward') as $id => $forward)
                        @if($id < 2)
                        <div class="input-group">
                              {{ Form::text('forward['.$id.'][email]',$forward['email'],array('placeholder' => trans('frontend.placeholder.forward'), 'class'=>'form-control forwarder'))}}
                              <span class="input-group-btn">
                                    {{ Form::button("+",array('class'=>"btn btn-primary addforwarder","onclick"=>"addforwarder()")) }}
                                    {{ Form::button("-",array('class'=>"btn btn-primary delforwarder","onclick"=>"delforwarder()")) }}
                              </span>     
                        </div>                
                        @else
                        {{ Form::text('forward['.$id.'][email]',$forward['email'],array('placeholder' => trans('frontend.placeholder.forward'), 'class'=>'form-control forwarder', 'id'=>$id))}}
                        @endif
                        @endforeach
                        @else
                        <div class="input-group">
                              {{ Form::text('forward[1][email]',"",array('placeholder' => trans('frontend.placeholder.forward'), 'class'=>'form-control forwarder'))}}
                              <span class="input-group-btn">
                                    {{ Form::button("+",array('class'=>"btn btn-primary addforwarder","onclick"=>"addforwarder()")) }}
                                    {{ Form::button("-",array('class'=>"btn btn-primary delforwarder","onclick"=>"delforwarder(1)")) }}
                              </span>                  
                        </div>                
                        @endif

                  </div>

                  <div class="form-group">
                        {{Form::submit(trans('frontend.button.email.store.submit'),array('class'=>"btn btn-primary"))}}                        
                  </div>
                  {{ Form::close() }}
            </div>
      </div>
</div>
@include('layouts.modal_password')
@stop

@section('scripts')
<script>
      function addforwarder(e) {
            id = $(".forwarder").length + 1;
            if (id <= 5) {
                  texto = '<input type="text" class="form-control forwarder" placeholder="ejemplo1@correo.com" name="forward[' + id + '][email]" id="' + id + '">';
                  $(".forwarders").append(texto);
            } else {
                  alert("solo se pueden agregar 5 redirecciones");
            }
      }

      function delforwarder(e) {
            id = $(".forwarder").length;
            $("#" + id).remove();
      }
</script>
@stop