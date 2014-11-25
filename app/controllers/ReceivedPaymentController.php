<?php

class ReceivedPaymentController extends \BaseController {

      public function index($user_id)
      {
            Session::flash('message',trans('frontend.messages.received_payment.realized'));
            return Redirect::route('user.payments.index',$user_id);
      }

      /**
       * Store a newly created resource in storage.
       * POST /receivedpayment
       *
       * @return Response
       */
      public function store()
      {
            //
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
            //
      }

}
