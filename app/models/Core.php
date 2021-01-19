<?php

namespace WebApp\Model;

use Stilmark\Database\Dba;

class Core {

	function __construct() {
		$this->db = new Dba();
	}

}