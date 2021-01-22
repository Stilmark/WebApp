<?php

namespace WebApp\Model;

use Stilmark\Database\Dba;

class Model
{
	public static $db;

	public static function init($table = '') {
		self::$db = new Dba();
		if ($table != '') {
			self::$db->table = $table;
		}
	}
}