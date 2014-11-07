<?php

class DomainListener {

    public function __construct(\PrimerServer\Services\WHM\WHMFunctions $whmFunctions)
    {
        $this->whmfunctions = $whmFunctions;
    }

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

    public function update($domain)
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

    public function destroy($domain)
    {
        if ($this->whmfunctions->delSubDomain($domain->server->nameserver, $domain->domain, explode(".",$domain->domain)[0], $domain->password))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}
