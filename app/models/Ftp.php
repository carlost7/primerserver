<?php

use LaravelBook\Ardent\Ardent;

class Ftp extends Ardent
{

      protected $table = 'ftps';
      
      //fillables
      protected $fillable = ['username', 'hostname', 'homedir'];
      
      //Rules of validations
      public static $rules = array(
          'username'>'required', 
          'hostname'>'required', 
          'homedir'=>'required'
      );
      
      //Relationships
      public static $relationsData = array(
          'domain' => array(self::HAS_ONE, 'Domain'),
      );
      
      //Auto Hydrate
      public $autoHydrateEntityFromInput = true;
      public $forceEntityHydrationFromInput = true;
      

}
