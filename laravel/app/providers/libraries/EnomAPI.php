<?php

/*
 * Class to work with the eNom webapi 
 */

/**
 * Description of enomapi
 *
 * @author carlos
 */
class EnomAPI {

      function __construct($uid, $pw, $response_type, $url)
      {
            $this->uid           = $uid;
            $this->pw            = $pw;
            $this->response_type = $response_type;
            $this->url           = $url;
      }

      public function create_url($args = array())
      {

            if (!is_array($args))
            {
                  Log::error('EnomAPI.create_url: empty arguments list');
                  return false;
            }

            if (!$this->validate_command($args))
            {
                  Log::error('EnomAPI.create_url: Bad command');
                  return false;
            }

            $user_data = array('responsetype' => $this->response_type, 'uid' => $this->uid, 'pw' => $this->pw);
            $auth      = http_build_query($user_data, '', '&');

            $data = http_build_query($args);
            $this->url .= $auth . '&' . $data;
            return $this->url;
      }

      protected function validate_command($args = array())
      {
            if (array_key_exists('command', $args))
            {
                  return true;
            }
            else
            {
                  return false;
            }
      }

      public function getResponse($url)
      {
            try {
                  $response = simplexml_load_file($url);
                  return $response;
            } catch (Exception $e) {
                  \Log::error('ENOMAPI.getResponse ' . $e->getMessage());
                  return null;
            }
      }

}
