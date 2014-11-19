<?php

use LaravelBook\Ardent\Ardent;

class Database extends Ardent {

      //Table
      protected $table                      = 'dbases';
      //Fillable
      protected $fillable                   = ['name_db', 'user', 'password', 'password_confirmation'];
      //Rules of validations
      public static $rules                  = array(
          "name_db"               => 'required|unique:dbases,name_db|max:63',
          "user"                  => 'required|unique:dbases,user|max:16',
          'password'              => 'required|min:8|confirmed',
          'password'              => array('regex:/^.*(?=.{8,15})(?=.*[a-z])(?=.*[A-Z])(?=.*[\d\W]).*$/'),
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

      public function beforeCreate()
      {
            if (!count(Event::fire('database.creating', array($this))))
            {
                  return false;
            }
            array_forget($this, 'password');
      }

      public function beforeDelete()
      {
            if (!count(Event::fire('database.deleting', array($this))))
            {
                  return false;
            }
      }

}
