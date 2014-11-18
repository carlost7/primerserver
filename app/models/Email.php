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
            if (!count(Event::fire('email.creating', array($this))))
            {
                  return false;
            }
            $forwards = "";
            foreach ($this->forward as $forward) {
                  if ($forward['email'] != "")
                  {
                        $forwards = $forwards . $forward['email'] . ",";
                  }
            }
            $this->forward = $forwards;
            $this->email   = $this->email . "@" . $this->domain->domain;
            array_forget($this, 'password');
      }

      public function beforeUpdate()
      {
            if ($this->password == "")
            {
                  array_forget($this, 'password');
            }
            if (null === Input::get('forward'))
            {
                  array_forget($this, 'forward');
            }

            if (!count(Event::fire('email.updating', array($this))))
            {
                  return false;
            }

            $this->forward = implode(",", $this->forward);
            array_forget($this, 'password');
      }

      public function beforeDelete()
      {
            if (!count(Event::fire('email.deleting', array($this))))
            {
                  return false;
            }
      }

}
