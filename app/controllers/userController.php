<?php

namespace WebApp\Controller;

use WebApp\Model\User;

class UserController extends Controller {

    function index() {
    	return User::list();
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