<?php

ini_set('display_errors',0);
register_shutdown_function('shutdown');

function shutdown()
{
    $error = error_get_last();
    if($error['type'] === E_ERROR ) {
        echo '<h2>Error</h2>';
        echo '<p>'.nl2br($error['message']).'</p>';
        echo '<p>'.$error['file'].' : '.$error['line'].'</p>';
        exit;
    }
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

function dumpdeluxe($args, $debug_backtrace)
{

    foreach($args AS $key => $var) {

        unset($label);

        if (is_string($var) && strpos($var, '[{') === 0 && $array = json_decode($var, true)) {

            $label = 'Json';
            $var = $array;
        }

        if (is_array($var) || is_object($var)) {

            // Fix for nodes that could not be json_encoded
            foreach($var AS $key => $node) {

                if (json_encode($node) == '') {
                    $var[$key] = 'Node could not be json encoded - use var_dump()';
                }
            }

            if (!isset($label)) {
                $label = (is_array($var)) ? 'Array':'Object';
                $label .= ' ('.count($var).')';
            }

            $str = json_encode($var, JSON_PRETTY_PRINT);

        } elseif (is_null($var)) {

            // NULL
            $label = 'NULL';
            $str = '<i>null</i>';

        } elseif ($var === true OR $var === false) {

            // Boolean
            $label = 'Boolean';
            $str = var_export($var, true);

        } elseif (is_int($var)) {

            // Integer
            $label = 'Integer';
            $str = $var;

        } elseif (is_float($var)) {

            // Float
            $label = 'Float';
            $str = $var;

        } else {

            $label = 'String ('.strlen($var).')';
            if ($var !== '0' && empty($var) && !(is_array($var) || is_object($var))) {
                $str = '<i>Empty string</i>';
            } else {
                $str = $var;
            }
        }

        if (!headers_sent()) {
            header('Content-Type: text/html; charset=utf-8');
        }

        $str = htmlentities($str);

        echo '<div class="debug label">'.$label.'</div><pre class="debug box">'.$str.'</pre>';
    }

    $trace = '<table class="debug trace">';

    foreach($debug_backtrace AS $backtrace) {

        $trace .= '
        <tr>
            <td>'.$backtrace['file'].'</td>
            <td>'.$backtrace['line'].'</td>
            <td>'.$backtrace['function'].'</td>
            <td>'.(isset($backtrace['class']) ? $backtrace['class']:'').'</td>
        </tr>
        ';
    }

    $trace .= '</table>';

    echo '<link rel="stylesheet" href="/css/debug.css" />';
    echo $trace.PHP_EOL;
}