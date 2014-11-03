<?php

use LaravelBook\Ardent\Ardent;

class Database extends Ardent {

    //Table
    protected $table                      = 'dbases';
    //Fillable
    protected $fillable                   = ['domain', 'nameserver', 'ip'];
    //Rules of validations
    public static $rules                  = array(
        "domain"     => 'required',
        "nameserver" => 'required',
        "ip"         => 'required'
    );
    //Relationships
    public static $relationsData          = array(
        'domain' => array(self::HAS_ONE, 'Domain'),
    );
    //Hydration
    public $autoHydrateEntityFromInput    = true;
    public $forceEntityHydrationFromInput = true;

}
