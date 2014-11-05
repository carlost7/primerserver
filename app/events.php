<?php

/*
 * ***********************************
 * lista de eventos a escuchar para mandar llamar a las aplicaciones
 * ***********************************
 */

//Event::listen('pago_aprobado', 'PagosListener@publicar_contenido');
Event::listen('eloquent.creating: Domain', 'DomainListener@store');
Event::listen('eloquent.creating: Domain', 'DomainListener@update');
Event::listen('eloquent.creating: Domain', 'DomainListener@destroy');

Event::listen('eloquent.creating: Ftp', 'FtpListener@store');
Event::listen('eloquent.creating: Ftp', 'FtpListener@update');
Event::listen('eloquent.creating: Ftp', 'FtpListener@destroy');

Event::listen('eloquent.creating: Email', 'EmailListener@store');
Event::listen('eloquent.creating: Email', 'EmailListener@update');
Event::listen('eloquent.creating: Email', 'EmailListener@destroy');

Event::listen('eloquent.creating: Database', 'DatabaseListener@store');
Event::listen('eloquent.creating: Database', 'DatabaseListener@update');
Event::listen('eloquent.creating: Database', 'DatabaseListener@destroy');



