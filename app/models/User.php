<?php

namespace WebApp\Model;

use Stilmark\Database\Dbi;

class User extends Dbi {

    public static $table = 'users';

    public static function some()
    {
    	return self::columns(['id', 'email'])->where(['id' => [1,3]])->list();
    }

}