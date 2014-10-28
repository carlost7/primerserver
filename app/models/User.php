<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class User extends Ardent implements UserInterface, RemindableInterface
{

      use UserTrait,
          RemindableTrait;

      public static $rules = array(
          "first_name"        => 'required',
          "last_name"         => 'required',
          "email"             => 'required|email|unique:users,email',
          'password'          => 'required|alpha_dash|min:8',
          'password_confirmation'  => 'required|same:password',
      );
      
      
      public static $passwordAttributes  = array('password','confirm_password');
      public $autoHashPasswordAttributes = true;
      public $autoHydrateEntityFromInput = true; 
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes = true;

      /**
       * The database table used by the model.
       *
       * @var string
       */
      protected $table = 'users';

      /**
       * The attributes excluded from the model's JSON form.
       *
       * @var array
       */
      protected $hidden = array('password', 'remember_token', 'type');

      /*
       * Fillable files
       */
      protected $fillable = array('first_name', 'last_name', 'email', 'telephone', 'cellphone', 'password', 'password_confirmation','type');

}
