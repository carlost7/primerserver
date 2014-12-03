<?php

class ReceivedPaymentListener {
      /*
       * Una vez que el pago ya esta realizado, vamos a actualizar el dominio con el nuevo pago,
       */

      public function store($payments)
      {
            //Aqui seleccionaremos en el futuro, las actualizaciones de objetos que se realizarán según el tipo de pago
            $payment                       = $payments[1];
            $domain                        = $payment->domain;
            $domain->active                = true;
            $domain->date_start            = \Carbon\Carbon::now();
            $domain->date_end              = \Carbon\Carbon::now()->addYear();
            $domain->password              = \Illuminate\Support\Facades\Crypt::decrypt($domain->domainPass->password);
            $domain->password_confirmation = \Illuminate\Support\Facades\Crypt::decrypt($domain->domainPass->password);
            //Actualizamos el dominio y con eso se agregará al servidor
            if ($domain->updateUniques())
            {
                  return true;                  
            }
            else
            {
                  return false;
            }
      }

}
