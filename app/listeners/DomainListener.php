<?php

class DomainListener {

    //Class constructor, injects automatically the whmfunctions provider
    public function __construct(\PrimerServer\Services\WHM\WHMFunctions $whmFunctions)
    {
        $this->whmfunctions = $whmFunctions;
    }

    //Calls addsubdomain and creates a domain in the server
    public function store($domain)
    {
        if ($this->whmfunctions->addSubDomain($domain->server->nameserver, $domain->domain, explode(".",$domain->domain)[0], $domain->password))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    //Calls delSubDomain and deletes the domain in the server
    public function destroy($domain)
    {
        if ($this->whmfunctions->delSubDomain($domain->server->nameserver, $domain->domain, explode(".",$domain->domain)[0]."_".$domain->server->domain))
        {
            return true;
        }
        else
        {
            return false;
        }
    }    

}
