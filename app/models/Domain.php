<?php

use LaravelBook\Ardent\Ardent;

class Domain extends Ardent {

    // Add your validation rules here
    public static $rules                  = [
        "domain"                => array(
            'regex:/^([a-z0-9]([-a-z0-9]*[a-z0-9])?\\.)+((a[cdefgilmnoqrstuwxz]|aero|arpa)|(b[abdefghijmnorstvwyz]|biz)|(c[acdfghiklmnorsuvxyz]|cat|com|coop)|d[ejkmoz]|(e[ceghrstu]|edu)|f[ijkmor]|(g[abdefghilmnpqrstuwy]|gov)|h[kmnrtu]|(i[delmnoqrst]|info|int)|(j[emop]|jobs)|k[eghimnprwyz]|l[abcikrstuvy]|(m[acdghklmnopqrstuvwxyz]|mil|mobi|museum)|(n[acefgilopruz]|name|net)|(om|org)|(p[aefghklmnrstwy]|pro)|qa|r[eouw]|s[abcdeghijklmnortvyz]|(t[cdfghjklmnoprtvwz]|travel)|u[agkmsyz]|v[aceginu]|w[fs]|y[etu]|z[amw])$/',
            'required',
            'unique:domains,domain'),
        "active"                => "required",
        "date_start"            => "date",
        "date_end"              => "date",
        'password'              => 'required|alpha_dash|min:8|confirmed',
        'password_confirmation' => 'required',
    ];
    public static $relationsData          = array(
        //Pertenece a
        'user'      => array(self::BELONGS_TO, 'User'),
        'plan'      => array(self::BELONGS_TO, 'Plan'),
        'server'    => array(self::BELONGS_TO, 'Server'),
        //Tiene
        'emails'    => array(self::HAS_MANY, 'Email'),
        'ftps'      => array(self::HAS_MANY, 'Ftp'),
        'databases' => array(self::HAS_MANY, 'Database'),
    );
    protected $table                      = 'domains';
    public $autoHydrateEntityFromInput    = true;
    public $forceEntityHydrationFromInput = true;
    public $autoPurgeRedundantAttributes  = true;
    // Don't forget to fill this array
    protected $fillable                   = ["domain", "active", "date_start", "date_end", 'password', 'password_confirmation'];

    public function beforeCreate()
    {
        unset($this->password);
    }

    public function beforeUpdate()
    {
        if (!count(Event::fire('domain.creating', array($this))))
        {
            return false;
        }
        array_forget($this, 'password');
    }

    public function beforeDelete()
    {
        if (!count(Event::fire('domain.deleting', array($this))))
        {
            return false;
        }
        array_forget($this, 'password');
    }

}
