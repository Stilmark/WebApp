<?php

use Symfony\Component\Dotenv\Dotenv;
use Stilmark\Parse\Request;
use Stilmark\Parse\Route;
use Stilmark\Parse\Dump;

define('ROOT', __DIR__);
define('WEBROOT', ROOT.'/public');

// Load .env variables
$dotenv = new Dotenv();
$dotenv->load(ROOT.'/.env');

// Locales
setlocale(LC_ALL, $_ENV['LOCALE']);
date_default_timezone_set($_ENV['TIMEZONE']);

require ROOT.'/lib/app.php';

// Include DEV functions
if ($_ENV['MODE'] == 'DEV') {
	require ROOT.'/lib/dev.php';
}

$output = Route::dispatch();

if (isset($output['template'])) {
	$loader = new \Twig\Loader\FilesystemLoader($_ENV['APPROOT'].'/templates');
	$twig = new \Twig\Environment($loader, [
	    'cache' => ROOT.'/cache/templates',
	    'auto_reload' => ($_ENV['MODE'] == 'DEV')
	]);
	echo $twig->render($output['template'].'.'.$_ENV['TEMPLATE_EXT'], $output['data']);
} else {
	echo Dump::json($output);
}





// echo Dump::json(User::limit(2)->list(), JSON_PRETTY_PRINT); exit;

