<?php

use LaravelBook\Ardent\Ardent;

class FreeDomain extends Ardent {

      // Add your validation rules here
      public static $rules         = [
          "active" => "required",
      ];
      protected $table             = 'free_domains';
      public static $relationsData = array(
          //Pertenece a
          'domain' => array(self::BELONGS_TO, 'Domain'),
          'user'   => array(self::BELONGS_TO, 'User'),
          'plan'   => array(self::BELONGS_TO, 'Plan'),
      );
      // Don't forget to fill this array
      protected $fillable          = ["active"];

}
