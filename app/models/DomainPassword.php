<?php

use LaravelBook\Ardent\Ardent;

class DomainPassword extends Ardent {

      // Add your validation rules here
      public static $rules                  = [
          'password'              => 'required|min:8|confirmed',
          'password'              => array('regex:/^.*(?=.{8,15})(?=.*[a-z])(?=.*[A-Z])(?=.*[\d\W]).*$/'),
          'password_confirmation' => 'required'
      ];
      public static $relationsData          = array(
          //Pertenece a
          'domain' => array(self::BELONGS_TO, 'Domain'),
      );
      protected $table                      = 'domain_passwords';
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;
      // Don't forget to fill this array
      protected $fillable                   = ['password', 'password_confirmation'];

      public function beforeSave()
      {
            $this->password = Illuminate\Support\Facades\Crypt::encrypt($this->password);
      }

}
