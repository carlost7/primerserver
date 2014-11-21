<?php

use LaravelBook\Ardent\Ardent;

class DomainCost extends Ardent {

      // Add your validation rules here
      public static $rules = [
          "domain"   => "required",
          "cost"     => "required",
          "concept"  => "required",
          "currency" => "required",
      ];
      protected $table                      = 'domain_costs';
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;
      // Don't forget to fill this array
      protected $fillable                   = ["domain", "cost", "concept", "currency"];

}
