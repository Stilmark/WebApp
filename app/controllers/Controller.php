<?php

namespace WebApp\Controller;

class Controller {

	function __construct($urlVars) {
		extract($urlVars);
        // dd($urlVars, $id);
	}

}