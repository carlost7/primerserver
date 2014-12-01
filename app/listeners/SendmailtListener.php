<?php

class SendmailListener {

      public function buy_domain_error($domain)
      {
            Illuminate\Support\Facades\Mail::send('sendmails.es.buydomainerror', array('domain',$domain), function($message) use ($domain){
                  $message->to($domain->user->email, $domain->user->first_name.$domain->user->last_name)->subject(trans('frontend.messages.system.buy_domain_error'));
            });
            return true;
      }

      public function buy_domain_success()
      {
            
      }

      public function domain_created_server()
      {
            
      }

      public function payment_created()
      {
            
      }

      public function received_payment_accepted()
      {
            
      }

      public function system_user_created()
      {
            
      }

}
