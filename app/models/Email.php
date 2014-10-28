<?php

use LaravelBook\Ardent\Ardent;

class Email extends Ardent {

      //Table
      protected $table = 'emails';
      
      //Fillable
	protected $fillable = ['user_email', 'email', 'forward'];
      
      //Rules of validations
      public static $rules = array(
          'user_email' => 'required', 
          'email' => 'required',
          'forward' => 'required',
      );
      
      //Relationships
      public static $relationsData = array(
          'domain' => array(self::BELONGS_TO, 'Domain'),          
      );
      
      //Hydrate
      public $autoHydrateEntityFromInput = true;
      public $forceEntityHydrationFromInput = true;
      
      

}