<?php

use LaravelBook\Ardent\Ardent;

class HostingCost extends Ardent {

      // Add your validation rules here
      public static $rules                  = array(
          "cost"     => "required",
          "currency" => "required",
          "concept"  => "required",
          "active"   => "boolean",
      );
      public static $relationsData          = array(
          'plan' => array(self::BELONGS_TO, 'Plan'),
      );
      protected $table                      = 'hosting_costs';
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;
      // Don't forget to fill this array
      protected $fillable                   = ["cost", "currency", "concept", "active"];

}
