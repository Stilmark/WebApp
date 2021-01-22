<?php

if ($_ENV['MODE'] == 'DEV') {

	$routes = include_once  ROOT.'/app/routes.php';
    $route_patterns = compileRoutes($routes);

    $rc = new FastRoute\RouteCollector(
        new FastRoute\RouteParser\Std(),
        new \FastRoute\DataGenerator\GroupCountBased()
    );

    foreach($route_patterns AS $pattern => $args) {
        list($request, $classMethod) = $args;
        list($className, $method) = explode('@', $classMethod);
        $rc->addRoute($request, $pattern, [$className, $method]);
    }

    file_put_contents( ROOT . '/cache/route.cache', '<?php return ' . var_export($rc->getData(), true) . ';' );
}

$dispatcher = FastRoute\cachedDispatcher(function(FastRoute\RouteCollector $r) {}, [
    'cacheFile' => ROOT . '/cache/route.cache',
    'cacheDisabled' => false
]);

$request = getRequest();

// Run dispatcher
$routeInfo = $dispatcher->dispatch($request['method'], $request['path']);

switch ($routeInfo[0]) {

    case FastRoute\Dispatcher::NOT_FOUND:

        header("HTTP/1.0 404 Not Found");
        echo json_encode(['error' => '404 Not Found']); exit;
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:

        $allowedMethods = $routeInfo[1];
        header("HTTP/1.0 405 Method Not Allowed");
        echo json_encode(['error' => '405 Method Not Allowed']); exit;
        break;

    case FastRoute\Dispatcher::FOUND:

        // Define classname and methods
        if (isset($routeInfo[1]) && is_string($routeInfo[1]) && strpos($routeInfo[1], '@')) {
            $call = explode('@', $routeInfo[1]);
            $className = $call[0];
            $method = $call[1];
        } else {
            $className = (isset($routeInfo[1][0])) ? $routeInfo[1][0]:'';
            $method = (isset($routeInfo[1][1])) ? $routeInfo[1][1]:'';
        }

        $urlVars = (isset($routeInfo[2])) ? $routeInfo[2]:[];

        if (isset($request['query'])) {
            $urlVars['query_string'] = $request['query'];
        }

        $namespaceClass = $_ENV['NAMESPACE'].'\\Controller\\'.$className;
        $queryTime = microtime(true);

        $data = (new $namespaceClass($urlVars))->$method();

        if (isset($_SERVER['HTTP_OUTPUT'])) { // Limit output

            if (isset($arr[$_SERVER['HTTP_OUTPUT']])) {
                $arr = $arr[$_SERVER['HTTP_OUTPUT']];
            } else {
                $arr = $data;
            }

        } else {
            $arr['data'] = $data;
        }

        echo json_encode($arr);
        break;
}
