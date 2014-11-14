<?php

use LaravelBook\Ardent\Ardent;

class Email extends Ardent {

    //Table
    protected $table                      = 'emails';
    //Fillable
    protected $fillable                   = ['user_email', 'email', 'forward', 'password', 'password_confirmation'];
    //Rules of validations
    public static $rules                  = array(
        'user_email'            => 'required',
        'email'                 => 'required',
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

    
    public function beforeCreate()
    {
        /*if (!count(Event::fire('email.creating', array($this))))
        {
            return false;
        }
        $this->email = $this->email . "@" . $this->domain->domain;
        array_forget($this, 'password');*/
        
        $this->forward = implode(",", $this->forward);
    }

    public function beforeUpdate()
    {
        if (!count(Event::fire('email.updating', array($this))))
        {
            return false;
        }
        array_forget($this, 'password');
    }

    public function beforeDelete()
    {
        if (!count(Event::fire('email.deleting', array($this))))
        {
            return false;
        }
        array_forget($this, 'password');
    }

}
