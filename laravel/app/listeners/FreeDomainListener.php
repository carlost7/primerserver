<?php

class FreeDomainListener {

      //Class constructor, injects automatically the whmfunctions provider
      public function __construct(\PrimerServer\Services\WHM\WHMFunctions $whmFunctions)
      {
            
      }

      //Calls addsubdomain and creates a domain in the server
      public function store($domain)
      {
            if ($domain->plan->plan_name = "free")
            {
                  $free         = new Freedomain;
                  $free->active = false;
                  $free->user()->associate($domain->user);
                  $free->domain()->associate($domain);
                  $free->plan()->associate($domain->plan);
                  if ($free->save())
                  {
                        return true;
                  }
                  else
                  {
                        Session::flash("error", trans('frontend.messages.freedomain.store.error'));
                        return false;
                  }
            }
            else
            {
                  return true;
            }
      }

      public function update($domain)
      {
            dd($domain);
      }

      //Calls delSubDomain and deletes the domain in the server
      public function destroy($domain)
      {
            dd($domain);
      }

}
