@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <ul class="nav nav-tabs" role="tablist">
            <li>{{HTML::LinkRoute('user.emails.index',trans('frontend.link.email.index'),array($user->id,$domain->id))}}</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-push-3">
            <h2>{{ trans('frontend.title.email.edit',array('email'=>$email->email)) }}</h2>

            <div class="instrucciones">
                <p>{{trans('frontend.instruction.email.edit')}}</p>
            </div>

            {{ Form::model($email,array("route" => array('user.emails.update',$user->id,$domain->id,$email->id),"method"=>'PUT')) }}

            @include('layouts.show_form_errors')
            <div class="form-group">                        
                {{ Form::label('email', trans('frontend.label.email')) }}
                {{ Form::text('email', Input::old('email'), array('placeholder' => trans('frontend.placeholder.email'), 'class'=>'form-control',"disabled"=>'disabled')) }}                    
            </div>
            <div class="form-group">
                {{ Form::label('user_email', trans('frontend.label.user_email')) }}
                {{ Form::text('user_email',Input::old('user_email'),array('placeholder' => trans('frontend.placeholder.user_email'), 'class'=>'form-control'))}}
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
                <!-- label -->
                <div class="input-group">
                    {{ Form::label('forward', trans('frontend.label.forward')) }}
                    <span class="input-group-btn">                        
                        {{ Form::button("+",array('class'=>"btn btn-primary addforwarder","onclick"=>"addforwarder()")) }}
                    </span>
                </div>

                <!-- Input -->                
                <?php $forwards = explode(",", $email->forward) ?>
                @foreach($forwards as $id => $forward)
                @if($forward != "")
                <div class="input-group" id="forwarder-{{$id}}">
                    {{ Form::text('forward['.$id.'][email]',$forward,array('placeholder' => trans('frontend.placeholder.forward'), 'class'=>'form-control forwarder'))}}
                    <span class="input-group-btn">                        
                        {{ Form::button("-",array('class'=>"btn btn-primary delforwarder","onclick"=>"delforwarder(".$id.")")) }}
                    </span>
                </div>
                @endif
                @endforeach              
            </div>
            <div class="form-group">
                {{Form::submit(trans('frontend.button.email.update.submit'),array('class'=>"btn btn-primary"))}}                        
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
        id = $(".forwarder").length;
        if (id <= 4) {
            texto = '<div class="input-group" id="forwarder-'+id+'"><input type = "text" value = "" name = "forward[' + id + '][email]" class = "form-control forwarder" placeholder = "ejemplo1@correo.com" ><span class = "input-group-btn"> <button type="button" onclick="delforwarder(' + id + ')" class = "btn btn-primary delforwarder">-</button></span></div>';
            $(".forwarders").append(texto);
        } else {
            alert("solo se pueden agregar 5 redirecciones");
        }
    }

    function delforwarder(id) {
        
        $("#forwarder-" + id).remove();
    }
</script>
@stop
