<?php

namespace WebApp\Controller;

use WebApp\Model\User;

class UserController extends Request {

    function index() {
    	return User::limit(100)->list();
    }

    function show() {
        return User::row( Request::args('id') );
    }

}