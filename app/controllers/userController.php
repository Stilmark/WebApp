<?php

namespace WebApp\Controller;

use WebApp\Model\User;
use Stilmark\Router\Request;

class UserController extends Controller {

    function index() {
    	return User::limit(1)->list();
    }

    function show() {

        return [
            'template' => 'hello',
            'data' => [
                'user' => User::row( Request::args('id') )
            ]
        ];
    }
}