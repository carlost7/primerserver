<?php

namespace PrimerServer\Services\Enom;

/**
 * Description of mercadoPago
 *
 * @author carlos
 */
class Enom {
      /*
       * Construimos la clase y mandamos llamar la libreria de enom, con los parametros de enom
       */

      public function __construct()
      {
            $this->enom = new \EnomAPI(
                    \Config::get('enom.uid'), \Config::get('enom.pw'), \Config::get('enom.response_type'), \Config::get('enom.url')
            );
      }

      /*
       * Check if domain is available
       * @params: sld (string): Second level domain, domain name
       *          tld (string): Top Level Domain
       * @return: true if domain is available, false if not available 
       */

      public function check_domain($sld, $tld)
      {

            $args = array(
                "command" => 'check',
                "sld"     => $sld,
                "tld"     => $tld,
            );

            $url       = $this->enom->create_url($args);
            $resultado = $this->enom->getResponse($url);
            if (isset($resultado))
            {
                  $rrpCode = $resultado->RRPCode;
                  $premium = $resultado->IsPremiumName;

                  if ($rrpCode == "210")
                  {
                        if ($premium != '')
                        {
                              return false;
                        }
                        return true;
                  }
                  else
                  {
                        return false;
                  }
            }
            else
            {
                  return null;
            }
      }

      public function get_similar_domains($tld, $sld)
      {
            $args = array(
                "command"          => "NameSpinner",
                "SLD"              => $sld,
                "TLD"              => $tld,
                "UseHyphens"       => true,
                "SensitiveContent" => true,
                "UseNumbers"       => false,
                "Topical"          => "medium",
                "Similar"          => "medium",
                "Related"          => "medium",
                "Basic"            => "medium",
                "MaxResults"       => 5,
            );

            $url       = $this->enom->create_url($args);
            $resultado = $this->enom->getResponse($url);
            $count     = $resultado->namespin->spincount;
            $dominios  = array();

            if ($count > 0)
            {
                  for ($i = 0; $i < $count; $i++) {
                        if ($resultado->namespin->domains->domain[$i]['com'] != 'n')
                        {
                              array_push($dominios, $resultado->namespin->domains->domain[$i]['name'] . ".com");
                        }

                        if ($resultado->namespin->domains->domain[$i]['net'] != 'n')
                        {
                              array_push($dominios, $resultado->namespin->domains->domain[$i]['name'] . ".net");
                        }
                  }
            }
            
            if (sizeof($dominios))
            {
                  return $dominios;
            }
            else
            {
                  return null;
            }
      }

      public function buy_domain($sld, $tld)
      {
            $args      = array(
                "command" => "Purchase",
                "sld"     => $sld,
                "tld"     => $tld,
                "useDNS"  => "default"
            );
            $url       = $this->enom->create_url($args);
            $resultado = $this->enom->getResponse($url);

            $rrpCode = $resultado->RRPCode;

            \Log::info('Enom.buy_domain ' . print_r($resultado, true));

            if ($rrpCode == "200" || $rrpCode=="1300")
            {
                  return true;
            }
            else
            {
                  return false;
            }
            return $resultado;
      }

      
      
      public function obtener_status_dominio($sld, $tld, $order_id)
      {
            $args      = array(
                "command"   => "GetDomainStatus",
                "sld"       => $sld,
                "tld"       => $tld,
                "orderid"   => $order_id,
                "ordertype" => purchase,
            );
            $this->enom->create_url($args);
            $resultado = $this->enom->getResponse();
      }

      public function obtener_lista_dominios()
      {
            $args      = array("command" => "GetDomains");
            $this->enom->create_url($args);
            $resultado = $this->enom->getResponse();
      }

      public function obtener_informacion_dominio($sld, $tld)
      {
            $args      = array(
                "command" => "GetDomainInfo",
                "sld"     => $sld,
                "tld"     => $tld,
            );
            $this->enom->create_url($args);
            $resultado = $this->enom->getResponse();
      }

      public function renovar()
      {
            $args = array(
                "command"  => "Extend",
                "sld"      => $sld,
                "tld"      => $tld,
                "NumYears" => 1,
            );
      }

}
