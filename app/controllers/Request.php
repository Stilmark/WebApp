<?php

namespace WebApp\Controller;

class Request {

	public static $Request;

	function __construct($urlVars)
	{
		self::$Request = $urlVars;
	}

	public function get($id = '')
	{
		if (empty($id)) {
			return extract(self::$Request);
		} else {
			return self::$Request[$id];
		}

	}

}