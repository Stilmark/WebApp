<?php

class Test {

	public static $db = 'Stocked';

	function __construct() {
		$this->db = 1;
	}

	public static function setDb() {
		return self::$db = 'unhinged';
	}

	public  function getDb() {
		return $this->db;
	}

}

echo Test::setDb();