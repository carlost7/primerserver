<?php

use LaravelBook\Ardent\Ardent;

class Payment extends Ardent {

      protected $fillable          = ["concept", "ammount", "currency", "description", "date_start", "date_end", "active", "no_order", "status"];
      //Rules of validations
      public static $rules         = array(
          "concept"     => 'required',
          "ammount"     => 'required',
          "currency"    => 'required',
          "description" => 'required',
          "date_start"  => 'required',
          "date_end"    => 'required',
          "active"      => 'required',
          "no_order"    => 'required',
          "status"      => 'required',
      );
      //Relationships
      public static $relationsData = array(
          'user'   => array(self::BELONGS_TO, 'User'),
          'domain' => array(self::BELONGS_TO, 'Domain'),
      );
      protected $table             = 'payments';

      public function getAmmountAttribute($value)
      {
            return money_format('%i', $value);
      }
      

}
