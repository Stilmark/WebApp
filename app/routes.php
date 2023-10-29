<?php

return [
    '/' => 	['GET', 'UserController@index'],

    '/api' => [
        '/users' =>         ['GET', 'UserController@index'],
        '/user' => [
            '/{id:\d+}' =>  ['GET', 'UserController@show']
        ],

    ],

    '/rpc' => [
        'GET', 'RpcController@test'
    ],

    '/signin' => [
            '' => ['GET', 'PageController@signin'],
            '/{provider:\w+}' => [
                '/callout'  => ['GET', 'SigninController@callout'],
                '/callback'  => ['GET', 'SigninController@callback'],
            ]
        ]
];

?>