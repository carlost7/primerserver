<?php

use LaravelBook\Ardent\Ardent;

class Email extends Ardent {

    //Table
    protected $table                      = 'emails';
    //Fillable
    protected $fillable                   = ['user_email', 'email', 'forward','password','password_confirmation'];
    //Rules of validations
    public static $rules                  = array(
        'user_email'            => 'required',
        'email'                 => 'required',
        'forward'               => '',
        'password'              => 'required|alpha_dash|min:8|confirmed',
        'password_confirmation' => 'required',
    );
    //Relationships
    public static $relationsData          = array(
        'domain' => array(self::BELONGS_TO, 'Domain'),
    );
    //Hydrate
    public $autoHydrateEntityFromInput    = true;
    public $forceEntityHydrationFromInput = true;
    public $autoPurgeRedundantAttributes  = true;
    public function beforeSave(){
        if(!strpos($this->email,"@")){
            $this->email = $this->email."@".$this->domain->domain;
        }        
        unset($this->password);        
    }

}
