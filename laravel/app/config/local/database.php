<?php
return array(

    'connections' => array(
        'mysql'  => array(
            'driver'    => 'mysql',
            'host'      => $_ENV['HOST'],
            'database'  => $_ENV['DATABASE'],
            'username'  => $_ENV['USERNAME'],
            'password'  => $_ENV['PASSWORD'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ),
    ),    
);
