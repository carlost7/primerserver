<?php

class HostingCost extends \Eloquent {

      // Add your validation rules here
      public static $rules         = [
          "cost"     => "required",
          "currency" => "required",
          "concept"  => "required",
          "active"   => "required",
      ];
      /*public static $relationsData = array(
          'plan' => array(self::BELONGS_TO, 'Plan'),
      );*/
      protected $table                      = 'hosting_costs';
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;
      // Don't forget to fill this array
      protected $fillable                   = ["cost", "currency", "concept", "active"];

}
