<?php

return [

    ## API
    '/api' => [
        '/users' =>         ['GET', 'UserController@index'],
        '/user/{id:\d+}' => ['GET', 'UserController@show'],
    ]
];

?>