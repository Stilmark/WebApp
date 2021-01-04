<?php



$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {

    $r->addRoute('GET', '/ping', 'View@ping');

    // $r->addGroup('/', function (FastRoute\RouteCollector $r) {});

});

var_dump($dispatcher);

require ROOT.'/App/routes.php';
