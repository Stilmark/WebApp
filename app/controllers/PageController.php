<?php

namespace WebApp\Controller;

use Stilmark\Router\Request;
use Stilmark\Parse\Vardump;

class PageController extends Controller {

    function home()
    {
        Vardump::json(['ok']);
    }

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