<?php

namespace WebApp\Controller;

use WebApp\Model\User;
use Stilmark\Parse\Request;

class UserController extends Request {

    function index() {
    	return User::limit(100)->list();
    }

    function show() {
        return User::row( Request::args('id') );
    }

}