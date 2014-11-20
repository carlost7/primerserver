<?php

class PaymentListener {

      public function __construct(\PrimerServer\Services\WHM\WHMFunctions $whmFunctions)
      {
            
      }

      /*
       * Creamos un pago a partir de un dominio
       */

      public function store($domain)
      {
            if ($domain->plan->plan_name == "free")
            {
                  return true;
            }
            else
            {
                  $no_order             = str_random(5);
                  ///Crearemos dos pagos, uno por el dominio y otro por el hosting
                  $payment              = new Payment;
                  $payment->concept     = $domain->plan->hostingCost->concept;
                  $payment->ammount     = $domain->plan->hostingCost->cost;
                  $payment->currency    = $domain->plan->hostingCost->currency;
                  $payment->description = "";
                  $payment->active      = true;
                  $payment->no_order    = $no_order;
                  $payment->status      = "started";

                  if ($payment->save())
                  {
                        $costDomain           = DomainCost::where('domain', substr($domain->domain, strpos($domain->domain, ".")))->first();
                        $payment              = new Payment;
                        $payment->concept     = $costDomain->concept;
                        $payment->ammount     = $costDomain->cost;
                        $payment->currency    = $costDomain->currency;
                        $payment->description = "";
                        $payment->active      = true;
                        $payment->no_order    = $no_order;
                        $payment->status      = "started";
                        if ($payment->save())
                        {
                              return true;
                        }
                  }
                  else
                  {
                        return false;
                  }
            }
      }

      /*
       * Actuaizamos el estatus del pago
       */

      public function update($payment)
      {
            dd($domain);
      }

      /*
       * Eliminamos un pago
       */

      public function destroy($payment)
      {
            dd($domain);
      }

}
