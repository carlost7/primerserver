<?php

class DatabaseListener {

    public function __construct(\PrimerServer\Services\WHM\WHMFunctions $whmFunctions)
    {
        $this->whmfunctions = $whmFunctions;
    }

    public function store($database)
    {
        dd($database);
    }

    public function update($database)
    {
        dd($database);
    }

    public function destroy($database)
    {
        dd($database);
    }

}
