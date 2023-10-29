<?php

namespace WebApp\Model;

use Stilmark\Database\Dbi;

class User extends Dbi {

    const softDelete = true;
    const table = ['u' => 'users'];
    const dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}