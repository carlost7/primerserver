<?php

use LaravelBook\Ardent\Ardent;

class Domain extends Ardent
{

      // Add your validation rules here
      public static $rules = [
          "domain" => "required",
          "active" => "required",
          "date_start" => "required|date",
          "date_end" => "required|date"
      ];
      
      public static $relationsData = array(
          //Pertenece a
          'user' => array(self::BELONGS_TO, 'User'),   
          'plan' => array(self::BELONGS_TO, 'Plan'),
          'server' => array(self::BELONGS_TO, 'Server'),
          
          //Tiene
          'mails' => array(self::HAS_MANY, 'Email'),
          'ftps' => array(self::HAS_MANY, 'Ftpr'),
          'databases' => array(self::HAS_MANY, 'Database'),
      );
      
      protected $table = 'domains';
      
      public $autoHydrateEntityFromInput = true;
      public $forceEntityHydrationFromInput = true;
      
      
      // Don't forget to fill this array
      protected $fillable = ["domain", "active", "date_start", "date_end"];

}
