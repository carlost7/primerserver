<?php

/*
 * ***********************************
 * lista de eventos a escuchar para mandar llamar a las aplicaciones
 * ***********************************
 */

//Event::listen('pago_aprobado', 'PagosListener@publicar_contenido');
Event::listen('domain.creating', 'DomainListener@store');
Event::listen('domain.updating', 'DomainListener@update');
Event::listen('domain.deleting', 'DomainListener@destroy');

Event::listen('ftp.creating', 'FtpListener@store');
Event::listen('ftp.updating', 'FtpListener@update');
Event::listen('ftp.deleting', 'FtpListener@destroy');

Event::listen('email.creating', 'EmailListener@store');
Event::listen('email.updating', 'EmailListener@update');
Event::listen('email.deleting', 'EmailListener@destroy');

Event::listen('database.creating', 'DatabaseListener@store');
Event::listen('database.updating', 'DatabaseListener@update');
Event::listen('database.deleting', 'DatabaseListener@destroy');



