<?php

class CheckdomainsController extends \BaseController {

      /**
       * Check if domain is available, if not return a list of possible domains
       *
       * @param  int  $id
       * @return Response
       */
      public function show($domain)
      {
            $validator = Validator::make($data      = array("domain" => $domain), Checkdomain::$rules);

            if ($validator->passes())
            {
                  $checkDomain         = new Checkdomain;
                  $checkDomain->domain = $domain;
                  $checkDomain->sld    = substr($domain, 0, strpos($domain, '.'));
                  $checkDomain->tld    = substr($domain, strpos($domain, '.') + 1);
                  $checkDomain->cost   = DomainCost::where('domain', $checkDomain->tld)->first()->cost;

                  $enom = New PrimerServer\Services\Enom\Enom();
                  if ($enom->check_domain($checkDomain->sld, $checkDomain->tld))
                  {
                        $result = array(
                            "status" => true,
                            "domain" => $checkDomain->domain,
                            "cost"   => '$' . $checkDomain->cost,
                        );
                  }
                  else
                  {
                        $enom = New PrimerServer\Services\Enom\Enom();

                        $optionalDomains = $enom->get_similar_domains($checkDomain->tld, $checkDomain->sld);

                        $checkdomains = array();

                        foreach ($optionalDomains as $optionalDomain) {
                              $checkDomain->domain = strtolower($optionalDomain);
                              $checkDomain->sld    = substr($optionalDomain, 0, strpos($optionalDomain, '.'));
                              $checkDomain->tld    = substr($optionalDomain, strpos($optionalDomain, '.') + 1);
                              $checkDomain->cost   = '$' . DomainCost::where('domain', $checkDomain->tld)->first()->cost;
                              array_push($checkdomains, $checkDomain);
                        }
                        
                        $options = View::make("checkdomains.show", compact("checkdomains"))->render();

                        $result = array(
                            "status"  => false,
                            "domain" => $domain,
                            "options" => $options,
                            "message" => "El dominio $domain, no esta disponible, prueba con otro o elige alguno de la lista"
                        );
                  }
            }
            else
            {
                  $result = array(
                      "status"  => false,
                      "message" => $validator->messages()->get('domain'),
                  );
            }

            return Response::json($result);
      }

}
