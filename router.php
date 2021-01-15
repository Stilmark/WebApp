<?php

function compileRoutes($arr, $path = '') {
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

define('AUTH', false);

if ($_ENV['MODE'] == 'DEV') {

	$routes = include_once  ROOT.'/app/routes.php';
    $route_patterns = compileRoutes($routes);

    $rc = new FastRoute\RouteCollector(
        new FastRoute\RouteParser\Std(),
        new \FastRoute\DataGenerator\GroupCountBased()
    );

    foreach($route_patterns AS $pattern => $args) {
        list($request, $classMethod, $auth) = $args;
        list($className, $method) = explode('@', $classMethod);
        $rc->addRoute($request, $pattern, [$className, $method]);
    }

    file_put_contents( ROOT . '/app/route.cache', '<?php return ' . var_export($rc->getData(), true) . ';' );

}

$dispatcher = FastRoute\cachedDispatcher(function(FastRoute\RouteCollector $r) {}, [
    'cacheFile' => ROOT . '/app/route.cache',
    'cacheDisabled' => false
]);

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

// Strip trailign slash and decode
$uri = rtrim(rawurldecode($uri), '/');

// Run dispatcher
$routeInfo = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $uri);


print_r($routeInfo);
exit;
