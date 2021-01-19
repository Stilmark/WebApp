<?php

namespace WebApp\Model;

class User extends Core {

	function __construct() {
		parent::__construct();
		$this->db->table = 'users';
	}

	function index() {
		$users = $this->db->list();
		return $users;
	}

	function show() {
		$users = $this->db->groupId('category');
		return $users;
	}

}