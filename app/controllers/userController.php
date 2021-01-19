<?php

namespace WebApp\Controller;

use WebApp\Model\User;

class UserController extends Controller {

    function index() {
    	return (new User())->index();
    }

    function show($id) {
        return (new User())->show($id);
    }

}