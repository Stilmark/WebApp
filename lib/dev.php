<?php

register_shutdown_function('shutdown');

function shutdown()
{
    $error = error_get_last();
    dd($error);
    if (isset($error['type']) && $error['type'] === E_ERROR) {
        // fatal error has occured
        dd($error);
    }
}

function redirect($url)
{
    header('Location: '.filter_var($url, FILTER_SANITIZE_URL));
    exit;
}

function dj()
{
    if (!headers_sent()) {
        header('Content-Type: text/json; charset=utf-8');
    }
    $args = func_get_args();
    echo json_encode($args, JSON_PRETTY_PRINT);
    exit;
}