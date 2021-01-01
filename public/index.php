<?php

## Composer autoloader
try {
    if (! @require __DIR__.'/../vendor/autoload.php') {
        throw new Exception ();
    }
} catch (Exception $e) {
	die('Install composer');
}

## Init
require __DIR__.'/../init.php';