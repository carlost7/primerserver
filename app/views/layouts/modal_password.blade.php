<!-- Modal -->
<div class="modal fade" id="ModalPassword" tabindex="-1" role="dialog" aria-labelledby="ModalPassword" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="ModalPasswordTitle">{{trans('frontend.modal_password.title')}}</h3>
            </div>
            <div class="modal-body">
                <p>{{trans('frontend.modal_password.instrucciones')}}</p>
                <h3 id='Usarpass'></h3>            
            </div>
            <div class="modal-footer">
                {{ Form::button(trans('frontend.modal_password.generate_another'),array('on_click'=>'get_password()','class'=>'btn btn-primary'))}}
                {{ Form::button(trans('frontend.modal_password.accept_password'),array('data_dismiss'=>'modal',"id"=>'SelectedPassword','class'=>'btn btn-primary'))}}
            </div>
        </div>
    </div>
</div>