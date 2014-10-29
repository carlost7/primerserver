<?php

use LaravelBook\Ardent\Ardent;

class Server extends Ardent
{

      protected $fillable = ['domain', 'nameserver', 'ip'];
      
      //Rules of validations
      public static $rules = array(
          "domain" => 'required',
          "nameserver" => 'required',
          "ip" => 'required'
      );
      
      //Relationships
      public static $relationsData = array(
          'plan' => array(self::BELONGS_TO, 'Plan'),          
          'domains' => array(self::HAS_MANY, 'Domain'),          
      );
      
      public $autoHydrateEntityFromInput = true;
      public $forceEntityHydrationFromInput = true;
      
      protected $table = 'servers';

}
