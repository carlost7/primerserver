<?php

use LaravelBook\Ardent\Ardent;

class Plan extends Ardent {

    public static $rules                  = array(
        "plan_name"       => 'required',
        "num_emails"      => 'required',
        "num_databases"   => 'required',
        "num_ftps"        => 'required',
        "quota_emails"    => 'required',
        "quota_databases" => 'required',
        "quota_ftps"      => 'required'
    );
    protected $table                      = 'plans';
    public static $relationsData          = array(
        'servers' => array(self::HAS_MANY, 'Server'),
    );
    public $autoHydrateEntityFromInput    = true;
    public $forceEntityHydrationFromInput = true;
    // Don't forget to fill this array
    protected $fillable                   = ["plan_name", "num_emails", "num_databases", "num_ftps", "quota_emails", "quota_databases", "quota_ftps"];

}
