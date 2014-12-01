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

                  //Agregamos un ftp por el dominio que creamos
                  $ftp                        = new Ftp;
                  $ftp->username              = explode('.', $domain->domain)[0];
                  $ftp->hostname              = $domain->server->domain;
                  $ftp->password              = Crypt::decrypt($domain->domainPass->password);
                  $ftp->password_confirmation = Crypt::decrypt($domain->domainPass->password);
                  $ftp->domain()->associate($domain);
                  if ($ftp->save())
                  {
                        $domain->domainPass->delete();
                        return true;
                  }
                  else
                  {
                        return false;
                  }
            }
            else
            {
                  dd($domain->errors());
            }
      }

}
