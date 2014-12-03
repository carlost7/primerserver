<?php

/*
 * ***********************************
 * lista de eventos a escuchar para mandar llamar a las aplicaciones
 * ***********************************
 */

//Event::listen('pago_aprobado', 'PagosListener@publicar_contenido');
Event::listen('domain.created', 'PaymentListener@store');
Event::listen('domain.created', 'FreeDomainListener@store');

/*Create domain in server*/
Event::listen('domain.updating', 'DomainListener@update');
/*Create ftp from new domain*/
Event::listen('domain.updated', 'DomainListener@update');
/*Notificar que el dominio ha sido creado */
Event::listen('domain.updated', 'SendmailListener@domain_created_server');

Event::listen('domain.deleting', 'DomainListener@destroy')
        ;

Event::listen('ftp.creating', 'FTPListener@store');
Event::listen('ftp.updating', 'FTPListener@update');
Event::listen('ftp.deleting', 'FTPListener@destroy');

Event::listen('email.creating', 'EmailListener@store');
Event::listen('email.updating', 'EmailListener@update');
Event::listen('email.deleting', 'EmailListener@destroy');

Event::listen('database.creating', 'DatabaseListener@store');
Event::listen('database.updating', 'DatabaseListener@update');
Event::listen('database.deleting', 'DatabaseListener@destroy');

/*Notifica pago recibido*/
Event::listen('payment.approved', 'SendmailListener@received_payment_accepted');
/*Compra el dominio en enom*/
Event::listen('payment.approved', 'EnomPaymentListener@store');
/*Actualiza el dominio de acuerdo al pago realizado*/
Event::listen('payment.approved', 'ReceivedPaymentListener@store');



/*
 * Here are event listener to send emails when actions occurred
 */
Event::listen('enom.domain.buy.error', 'SendmailListener@buy_domain_error');
Event::listen('enom.domain.buy.success', 'SendmailListener@buy_domain_success');

Event::listen('payment.created', 'SendmailListener@payment_created');

Event::listen('system.user.created', 'SendmailListener@system_user_created');

