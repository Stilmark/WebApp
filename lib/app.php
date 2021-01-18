<?php

// App
function redirect($url)
{
    header('Location: '.filter_var($url, FILTER_SANITIZE_URL));
    exit;
}

// Routes
function compileRoutes($arr, $path = '')
{
    global $route_list;
    foreach ($arr as $key => $value) {
        if (is_array($value)) {
            compileRoutes($value, $path.$key);
        } else {
            $route_list[$path][] = $value;
            // echo "$path : $value<br>";
        }
    }
    return $route_list;
}

// Request
function Request()
{
    $request = parse_url($_SERVER['REQUEST_URI']);
    $request['method'] = $_SERVER['REQUEST_METHOD'];
    if (isset($request['query'])) {
        parse_str($request['query'], $request['query']);
    }
	return $request;
}