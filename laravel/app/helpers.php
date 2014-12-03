<?php

/*
 * Obtenemos el servidor que tenga el menor numero de cuentas de acuerdo al plan que se elija * 
 */

function getLeastBussyServer($plan)
{
    //Obtenemos el numero de cuentas por servidor
    $servers = array();
    foreach ($plan->servers as $server) {
        $servers = array_add($servers, $server->id, count($server->domains));
    }
    $mins = array_keys($servers, min($servers));
    //obtenemos el servidor con menos cuentas
    return $plan->servers->find($mins[0]);
}
