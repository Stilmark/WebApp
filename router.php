<?php

// In development write routes to cache

if ($_ENV['MODE'] == 'DEV') {

	$routes = include_once  ROOT.'/app/routes.php';

    $rc = new FastRoute\RouteCollector(
        new FastRoute\RouteParser\Std(),
        new \FastRoute\DataGenerator\GroupCountBased()
    );

    array_walk($routes, function($routes, $pattern) use ($rc) {
        list($className, $method, $request) = $routes;
        $rc->addRoute($request, $pattern, [$className, $method]);
    });

    file_put_contents( ROOT . '/cache/route.cache', '<?php return ' . var_export($rc->getData(), true) . ';' );

}

$dispatcher = FastRoute\cachedDispatcher(function(FastRoute\RouteCollector $r) {

}, [
    'cacheFile' => ROOT . '/cache/route.cache',
    'cacheDisabled' => false
]);

print_r($dispatcher);
exit;
