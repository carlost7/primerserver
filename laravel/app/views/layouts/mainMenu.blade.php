<div class="col-md-4 sidebar dominios ">
    <ul class="nav nav-tabs" role="tablist">
        @if(isset($activo))
        <li><a href="{{ route('user.show',array(Auth::user()->id)) }} "> Principal</a></li>
        @endif
        
        @if(isset($activo)&&$activo!="dominios")
        
        <li>{{HTML::LinkRoute('user.domains.create',trans('frontend.link.domain.create'),$user->id)}}</li>
        
        @endif
        
        @if(isset($activo)&&$activo!="pagos")
        
        <li><a href="{{URL::route('user.payments.index',$user->id)}}">{{trans('frontend.link.payment.index')}}</a></li>
        
        @endif
        
        @if(isset($activo)&&$activo!="usuario")
        
        <li>{{HTML::LinkRoute('user.edit',trans('frontend.link.user.edit'),array(Auth::user()->id))}}</li>
        
        @endif
                                 
    </ul>
</div>

