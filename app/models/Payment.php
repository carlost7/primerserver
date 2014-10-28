<?php

use LaravelBook\Ardent\Ardent;

class Payment extends Ardent
{

      protected $fillable = ["concept", "ammount", "currency", "description", "date_start", "date_end", "active", "no_order", "status"];
      //Rules of validations
      public static $rules = array(
          "concept" => 'required',
          "ammount" => 'required',
          "currency" => 'required',
          "description" => 'required',
          "date_start" => 'required',
          "date_end" => 'required',
          "active" => 'required',
          "no_order" => 'required',
          "status" => 'required',
      );
      //Relationships
      public static $relationsData = array(
          'user' => array(self::BELONGS_TO, 'User'),
      );
      public $autoHydrateEntityFromInput = true;
      public $forceEntityHydrationFromInput = true;
      protected $table = 'payments';

}
