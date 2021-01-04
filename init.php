<?php

use Symfony\Component\Dotenv\Dotenv;
use Stilmark\Database\Dba;

define('ROOT', __DIR__);
define('WEBROOT', ROOT.'/public');

// Load .env variables
$dotenv = new Dotenv();
$dotenv->load(ROOT.'/.env');

// Load routes
require ROOT.'/router.php';

// Locales
setlocale(LC_ALL, $_ENV['LOCALE']);
date_default_timezone_set($_ENV['TIMEZONE']);

$db= new Dba();

$users = $db->table('users')->groupId('category');
header('Content-Type: application/json');
echo json_encode($users).PHP_EOL;
