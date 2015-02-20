<div class="col-md-4 sidebar dominios ">
    <ul class="nav nav-tabs" role="tablist">

        @if($page=='principal')
        <li>{{HTML::LinkRoute('user.show',trans('frontend.link.domain.index'),$user->id)}}</li>
        @else
        <li>{{HTML::LinkRoute('user.domains.show',$domain->domain,array($user->id,$domain->id))}}</li>
        @endif
        <li>{{ HTML::linkRoute('user.emails.index',trans('frontend.link.email.index'),array('user_id'=>$user->id,'domain_id'=>$domain->id)) }}</li>                    
        <li>{{ HTML::linkRoute('user.databases.index',trans('frontend.link.database.index'),array('user_id'=>$user->id,'domain_id'=>$domain->id)) }}</li>                  
        <li>{{ HTML::linkRoute('user.ftps.index',trans('frontend.link.ftp.index'),array('user_id'=>$user->id,'domain_id'=>$domain->id)) }}</li>                  
    </ul>
</div>