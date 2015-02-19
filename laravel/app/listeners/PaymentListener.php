<?php

class PaymentListener {
      /*
       * Una vez que el pago ya esta realizado, vamos a actualizar el dominio con el nuevo pago,
       */

      public function store($domain)
      {
            if ($domain->plan->plan_name == "free")
            {
                  return true;
            }
            else
            {

                  $no_order = str_random(5);

                  ///Crearemos dos pagos, uno por el dominio y otro por el hosting

                  /*
                   * Hosting
                   */
                  $payment              = new Payment;
                  $payment->concept     = $domain->plan->hostingCost->concept;
                  $payment->ammount     = $domain->plan->hostingCost->cost;
                  $payment->currency    = $domain->plan->hostingCost->currency;
                  $payment->description = $domain->plan->plan_name;
                  $payment->active      = true;
                  $payment->no_order    = $no_order;
                  $payment->status      = "started";                  
                  $payment->type        = "dominio";
                  $payment->date_start  = \Carbon\Carbon::now();
                  $payment->date_end    = \Carbon\Carbon::now();
                  $payment->user()->associate($domain->user);
                  $payment->domain()->associate($domain);

                  if ($payment->save())
                  {
                        $costDomain           = DomainCost::where('domain', substr($domain->domain, strpos($domain->domain, ".") + 1))->first();
                        /*
                         * Dominio
                         */
                        $payment              = new Payment;
                        $payment->concept     = $costDomain->concept;
                        $payment->ammount     = $costDomain->cost;
                        $payment->currency    = $costDomain->currency;
                        $payment->description = $domain->domain;
                        $payment->active      = true;
                        $payment->no_order    = $no_order;
                        $payment->status      = "started";
                        $payment->date_start  = \Carbon\Carbon::now();
                        $payment->date_end    = \Carbon\Carbon::now();
                        $payment->type        = "host";
                        $payment->user()->associate($domain->user);
                        $payment->domain()->associate($domain);
                        if ($payment->save())
                        {
                              return true;
                        }
                        else
                        {
                              Session::flash("error", trans("frontend.messages.payments.store.error"));
                              return false;
                        }
                  }
                  else
                  {
                        Session::flash("error", trans("frontend.messages.payments.store.error"));
                        return false;
                  }
            }
      }

}
