<?php

return [

    ## API
    '/' => 	['GET', 'UserController@index'],
    '/api' => [
        '/users' =>         ['GET', 'UserController@index'],
        '/user' => [
            '/{id:\d+}' =>  ['GET', 'UserController@show'],
            // '/{id:\d+}' =>  ['GET', 'UserController@show', AUTH],
        ]
    ]
];

?>