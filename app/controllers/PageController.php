<?php

namespace WebApp\Controller;

use Stilmark\Router\Request;

class PageController extends Controller {

	function signin()
	{

        return [
            'template' => 'signin',
            'data' => [
                'providers' => explode(',',$_ENV['OAUTH_CLIENTS']),
                'user' => $_SESSION['user'] ?? null
            ]
        ];
	}

}