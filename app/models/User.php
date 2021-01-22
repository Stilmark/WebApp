<?php

namespace WebApp\Model;

class User extends Model {

	public static function index() {
		self::init('users');
		return self::$db->list();
	}

	public static function show($id) {
		self::init('users');
		return self::$db->rowId($id);
	}

}