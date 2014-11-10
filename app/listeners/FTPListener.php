<?php

class FTPListener {

    //Class constructor, injects automatically the whmfunctions provider
    public function __construct(\PrimerServer\Services\WHM\WHMFunctions $whmFunctions)
    {
        $this->whmfunctions = $whmFunctions;
    }

    //Calls createFTP and creates a new ftp 
    public function store($ftp)
    {
        if ($this->whmfunctions->addFTP($ftp->domain->server->nameserver, $ftp->username , $ftp->password, $ftp->domain->plan->quota_ftps, $ftp->homedir))
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
        if ($this->whmfunctions->addSubDomain($ftp->server->nameserver, $ftp->domain, explode(".",$ftp->domain)[0], $ftp->password))
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
        if ($this->whmfunctions->delSubDomain($ftp->server->nameserver, $ftp->domain, explode(".",$ftp->domain)[0]."_".$ftp->server->domain))
        {
            return true;
        }
        else
        {
            return false;
        }
    }    


}
