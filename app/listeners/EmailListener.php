<?php

class EmailListener {

    public function __construct(\PrimerServer\Services\WHM\WHMFunctions $whmFunctions)
    {
        $this->whmfunctions = $whmFunctions;
    }

    public function destroy($email)
    {
        if ($this->whmfunctions->delMail($email->domain->server->nameserver, $email->domain->domain, explode("@", $email->email)[0]))
        {
            if ($email->forward)
            {

                $forwards = explode(",", $email->forward);
                foreach ($forwards as $forward) {
                    if (!$this->whmfunctions->delForward($email->domain->server->nameserver, $email->email, $forward))
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

    public function store($email)
    {
        
        if ($this->whmfunctions->addMail($email->domain->server->nameserver, $email->domain->domain, $email->email, $email->password, $email->domain->plan->quota_emails))
        {
            if ($email->forward)
            {
                foreach ($email->forward as $forward) {
                    if (!$this->whmfunctions->addForward($email->domain->server->nameserver, $email->domain->domain, explode("@", $email->email)[0], $forward['email']))
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

    public function update($email)
    {
        if (isset($email->password))
        {
            if (!$this->whmfunctions->changePassword($email->domain->server->nameserver, $domain->domain, explode("@", $email->email)[0], $email->password))
            {
                return false;
            }
        }

        //Buscaremos las diferencias entre lo que esta en la base de datos y lo que agrego el usuario
        $current_forwards = [];
        $new_forwards     = [];

        $saved_email = Email::find($email->id);
        if ($saved_email->forward)
        {
            $current_forwards = explode(",", $saved_email->forward);
        }
        if ($email->forward)
        {
            $new_forwards = explode(",", $email->forward);
        }
        $added_forwards   = array_diff($new_forwards, $current_forwards);        
        $deleted_forwards = array_diff($current_forwards, $new_forwards);
        $total_forwards = array_merge(array_intersect($current_forwards, $added_forwards), $added_forwards);
        $email->forward = $total_forwards;
        dd($added_forwards);
        dd($deleted_forwards);

        foreach ($added_forwards as $forward) {
            if (!$this->whmfunctions->addForward($email->domain->server->nameserver, $domain->domain, explode("@", $email->email)[0], $forward))
            {
                return false;
            }
        }
        foreach ($deleted_forwards as $forward) {
            if (!$this->whmfunctions->delForward($email->domain->server->nameserver, $email->email, $forward))
            {
                return false;
            }
        }

        return true;
    }

}
