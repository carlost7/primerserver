<?php

class PaymentsController extends \BaseController {

      /**
       * Display a listing of payments
       *
       * @return Response
       */
      public function index($user_id)
      {
            $user     = User::findOrFail($user_id);
            $payments = Payment::select(DB::raw('sum(ammount) ammount, domain_id, currency , no_order, status'))->where('user_id',$user_id)->groupBy('no_order')->orderBy("created_at","descend")->paginate(10);

            return View::make('payments.index', compact('payments', 'user'));
      }

      /**
       * Display the specified payment.
       *
       * @param  int  $id
       * @return Response
       */
      public function show($user_id, $no_order)
      {
            $user     = User::findOrFail($user_id);
            $payments = Payment::where('no_order', $no_order)->get();

            return View::make('payments.show', compact('user', 'payments'));
      }

      /**
       * We send the user to the payment page;
       *
       * @param  int  $id
       * @return Response
       */
      public function update($user_id, $no_order)
      {
            $user     = User::findOrFail($user_id);
            $payments = Payment::where('no_order', $no_order)->get();
            
            $mercadoPago = new PrimerServer\Services\MercadoPago\MercadoPago();
            
            $preference = $mercadoPago->generate_preference($user,$payments);
            
            if (isset($preference))
            {
                  $link = $preference['response'][Config::get('payment.init_point')];
                  return Redirect::away($link);
            }
            else
            {
                  Session::flash('error', trans('frontend.messages.payment,update.error'));
                  return Redirect::back();
            }
      }

      /**
       * Remove the specified payment from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($user_id, $no_order)
      {
            $user   = User::findOrFail($user_id);
            $domain = Domain::findOrFail($domain_id);

            if (Email::destroy($id))
            {
                  Session::flash('message', trans('frontend.messages.payment.destroy.successful'));
            }
            else
            {
                  Session::flash('error', trans('frontend.messages.payment.destroy.error'));
            }
            return Redirect::route('user.payments.index', array($user->id, $domain->id));
      }

}
