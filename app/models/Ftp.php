<?php

use LaravelBook\Ardent\Ardent;

class Ftp extends Ardent {

    protected $table                      = 'ftps';
    //fillables
    protected $fillable                   = ['username', 'hostname', 'homedir','password','password_confirmation'];
    //Rules of validations
    public static $rules                  = array(
        'username'              => 'required',
        'hostname'              => 'required',
        'homedir'               => 'required',
        'password'              => 'required|alpha_dash|min:8|confirmed',
        'password_confirmation' => 'required',
    );
    //Relationships
    public static $relationsData          = array(
        'domain' => array(self::BELONGS_TO, 'Domain'),
    );
    //Auto Hydrate
    public $autoHydrateEntityFromInput    = true;
    public $forceEntityHydrationFromInput = true;
    public $autoPurgeRedundantAttributes  = true;

    public function beforeSave()
    {
        unset($this->password);
    }

}
