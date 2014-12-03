<?php

class SendmailListener {

      public function buy_domain_error($domain)
      {
            Illuminate\Support\Facades\Mail::send('sendmails.es.buydomainerror', array('domain'=>$domain), function($message) use ($domain){
                  $message->to($domain->user->email, $domain->user->first_name.$domain->user->last_name)->subject(trans('frontend.title.system.buy_domain_error'));
            });            
            return true;
      }

      public function buy_domain_success()
      {
            
      }

      public function domain_created_server($domain)
      {
            Illuminate\Support\Facades\Mail::send('sendmails.es.domaincreatedserver', array('domain'=>$domain), function($message) use ($domain){
                  $message->to($domain->user->email, $domain->user->first_name." ".$domain->user->last_name)->subject(trans('frontend.title.system.domain_created_server'));
            });            
            return true;
      }

      public function payment_created()
      {
            
      }

      public function received_payment_accepted($payments)
      {
            $payment = $payments->first();
            Illuminate\Support\Facades\Mail::send('sendmails.es.receivedpaymentaccepted', array('payment'=>$payment), function($message) use ($payment){
                  $message->to($payment->user->email, $payment->user->first_name." ".$payment->user->last_name)->subject(trans('frontend.title.system.payment_received_approved'));
            });            
            return true;
      }

      public function system_user_created($user)
      {
            Illuminate\Support\Facades\Mail::send('sendmails.es.systemusercreated', array('user'=>$user), function($message) use ($user){
                  $message->to($user->email, $user->first_name." ".$user->last_name)->subject(trans('frontend.title.system.new_user_created'));
            });            
            return true;
      }

}
