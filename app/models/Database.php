<?php

use LaravelBook\Ardent\Ardent;

class Database extends Ardent {

    //Table
    protected $table                      = 'dbases';
    //Fillable
    protected $fillable                   = ['name_db', 'user','password','password_confirmation'];
    //Rules of validations
    public static $rules                  = array(
        "name_db"               => 'required',
        "user"                  => 'required',
        'password'              => 'required|alpha_dash|min:8|confirmed',
        'password_confirmation' => 'required',
    );
    //Relationships
    public static $relationsData          = array(
        'domain' => array(self::BELONGS_TO, 'Domain'),
    );
    //Hydration
    public $autoHydrateEntityFromInput    = true;
    public $forceEntityHydrationFromInput = true;
    public $autoPurgeRedundantAttributes  = true;

    public function beforeSave()
    {
        array_forget($this, 'password');
    }

}
