<?php

use Illuminate\Events\Dispatcher;

class ReceivedPaymentController extends \BaseController {

      public function __construct(Dispatcher $events)
      {
            $this->events = $events;
      }

      public function index($user_id)
      {
            Session::flash('message', trans('frontend.messages.received_payment.realized'));
            return Redirect::route('user.payments.index', $user_id);
      }

      /**
       * Store a newly created resource in storage.
       * POST /receivedpayment
       *
       * @return Response
       */
      public function store()
      {
            Log::error("referer> " . Request::referrer());
            $id = Input::get('id');
            if (isset($id))
            {
                  $mercadoPago = new PrimerServer\Services\MercadoPago\MercadoPago();
                  $response    = $mercadoPago->receive_notification($id);
                  Log::error("Respuestaa de MercadoPago: " . print_r($response, true));
                  if (isset($response))
                  {

                        $external_reference = $response['collection']['external_reference'];
                        $status             = $response['collection']['status'];

                        $payments = Payment::where('no_order', $external_reference)->get();

                        if (count($payments))
                        {
                              foreach ($payments as $payment) {

                                    $payment->status   = $status;
                                    $payment->date_end = \Carbon\Carbon::now()->addYear();
                                    if ($status == "approved")
                                    {
                                          $payment->active = false;
                                    }
                                    if ($payment->update())
                                    {
                                          switch ($status) {
                                                case 'approved':
                                                      $this->events->fire('payment.approved', array($payments));
                                                      echo "cambios realizados";
                                                      break;
                                                default:
                                                      $this->events->fire('payment.canceled', array($payments));
                                                      echo "status diferente a aprobado";
                                                      break;
                                          }
                                    }
                                    else
                                    {
                                          break;
                                    }
                              }
                        }
                        else
                        {
                              echo "Datos de prueba";
                        }
                  }
                  else
                  {
                        Log::error('ReceivedPaymentsController.store No se recibio informacion de pago ID:' . $id);
                        echo "no recibido";
                  }
            }
            else
            {
                  echo "no recibi nada";
            }
      }

      /**
       * Update the specified resource in storage.
       * PUT /receivedpayment/{id}
       *
       * @param  int  $id
       * @return Response
       */
      public function update()
      {
          
            //Log::info('PagosController.recibir_notificacion_prueba entrada de datos');
            $exref  = Input::get('external_reference');
            $status = Input::get('collection_status');

            $response = array("external_reference" => $exref, "status" => $status);
            if (isset($response))
            {

                  $external_reference = $response['external_reference'];
                  $status             = $response['status'];

                  $no_orders = explode("-", $external_reference);
                  $payments = Payment::whereIn('no_order', $no_orders)->get();
                  
                  foreach ($payments as $payment) {

                        $payment->status   = $status;
                        $payment->date_end = \Carbon\Carbon::now()->addYear();
                        if ($status == "approved")
                        {
                              $payment->active = false;
                        }
                        $payment->update();                        
                  }
                  
                  switch ($status) {
                        case 'approved':
                              $this->events->fire('payment.approved', array($payments));
                              echo "cambios realizados";
                              break;
                        default:
                              $this->events->fire('payment.canceled', array($payments));
                              echo "status diferente a aprobado";
                              break;
                  }
            }
            else
            {
                  echo "no recibido";
            }
      }

}
