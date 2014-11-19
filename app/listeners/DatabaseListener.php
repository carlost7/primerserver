<?php

class DatabaseListener {

      public function __construct(\PrimerServer\Services\WHM\WHMFunctions $whmFunctions)
      {
            $this->whmfunctions = $whmFunctions;
      }

      public function store($database)
      {
            if ($this->whmfunctions->addDb($database->domain->server->nameserver, $database->user, $database->password, $database->name_db))
            {
                  return true;
            }
            else
            {
                  return false;
            }
      }

      public function update($database)
      {
            if ($this->whmfunctions->delMail($database->domain->server->nameserver, $database->domain->domain, explode("@", $database->database)[0]))
            {
                  if ($database->forward)
                  {

                        $forwards = explode(",", $database->forward);
                        foreach ($forwards as $forward) {
                              if (!$this->whmfunctions->delForward($database->domain->server->nameserver, $database->database, $forward))
                              {
                                    return false;
                              }
                        }
                  }
                  return true;
            }
            else
            {
                  return false;
            }
      }

      public function destroy($database)
      {
            if ($this->whmfunctions->delDb($database->domain->server->nameserver, $database->domain->server->nameserver."_".$database->name_db,$database->domain->server->nameserver."_".$database->user))
            {
                  return true;
            }
            else
            {
                  return false;
            }
      }

}
