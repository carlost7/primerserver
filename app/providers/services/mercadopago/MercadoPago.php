<?php

namespace PrimerServer\Services\MercadoPago;

/**
 * Description of mercadoPago
 *
 * @author carlos
 */
class MercadoPago {

      public function __construct()
      {
            $this->mp = new \MP(\Config::get('payment.client_id'), \Config::get('payment.client_socket'));
            $this->mp->sandbox_mode(\Config::get('payment.sandbox_mode'));
      }

      /*
       * Generamos una preferencia de pago a partir de la clase
       * Payments: Collection containing payments
       */

      public function generate_preference($user,$payments)
      {
            //Empty array
            $items = array();
            $id = "";
            
            
            foreach ($payments as $payment) {
                  $item = array(
                      "title"       => $payment->concept,
                      "description" => $payment->description,
                      "quantity"    => 1,
                      "currency_id" => $payment->currency,
                      "unit_price"  => doubleval($payment->ammount)
                  );
                  $id = $payment->no_order;
                  array_push($items,$item);
                  
            }

            //Generate payment url
            if (\Config::get('payment.sandbox_mode'))
            {
                  $referer = \URL::route('receive_payment.index',$user->id);
            }
            else
            {
                  $referer = \URL::route('receive_payment.index',$user->id);
            }

            $preference_data = array(
                "items"              => $items,
                "payer"              => array(
                    "name"  => $user->name,
                    "email" => $user->email,
                ),
                "back_urls"          => array(
                    "success" => $referer,
                    "failure" => $referer,
                    "pending" => $referer,
                ),
                "external_reference" => $id,
            );

            $preference = $this->mp->create_preference($preference_data);
            return $preference;
      }

      
      public function recibir_notificacion($id)
      {
            $payment_info = $this->mp->get_payment_info($id);

            // Show payment information
            if ($payment_info["status"] == 200)
            {
                  return $payment_info['response'];
            }
            else
            {
                  return null;
            }
      }

}
