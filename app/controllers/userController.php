<?php

namespace WebApp\Controller;

use WebApp\Model\User;

class UserController extends Request {

    function index() {
    	return User::index();
    }

    function show() {
        return User::show( Request::get('id') );
    }

}