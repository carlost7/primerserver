<?php

class FTPListener {

      public function __construct(\PrimerServer\Services\WHM\WHMFunctions $whmFunctions)
      {
            $this->whmfunctions = $whmFunctions;
      }

      //Calls createFTP and creates a new ftp 
      public function store($ftp)
      {
            if ($this->whmfunctions->addFTP($ftp->domain->server->nameserver, $ftp->username, $ftp->password, $ftp->domain->plan->quota_ftps, $ftp->homedir))
            {
                  return true;
            }
            else
            {
                  return false;
            }
      }

      //Calls updateFTP and changes password from ftp
      public function update($ftp)
      {
            if ($this->whmfunctions->updateFTP($ftp->domain->server->nameserver, $ftp->username, $ftp->password))
            {
                  return true;
            }
            else
            {
                  return false;
            }
      }

      //Calls delFTP and deletes the contents on the ftp directory
      public function destroy($ftp)
      {
            if ($this->whmfunctions->delFTP($ftp->domain->server->nameserver, $ftp->username . "@" . $ftp->hostname, true))
            {
                  return true;
            }
            else
            {
                  return false;
            }
      }

      public function create_ftp($domain)
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

}
