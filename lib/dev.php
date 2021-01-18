<?php

ini_set('display_errors',0);
register_shutdown_function('shutdown');

function shutdown()
{
    if(!is_null($e = error_get_last()) && ($e['type'] == 8)) {
        dj($e);
    }
}



function redirect($url)
{
    header('Location: '.filter_var($url, FILTER_SANITIZE_URL));
    exit;
}

function dd()
{
    dumpdeluxe(func_get_args(), debug_backtrace());
    exit;
}

function dj()
{

    $json = json_encode(func_get_args(), JSON_PRETTY_PRINT);

    if (!headers_sent()) {
        header('Content-Type: text/json; charset=utf-8');
        echo $json;
    } else {
        echo '<pre>'.$json.'</pre>';
    }
}