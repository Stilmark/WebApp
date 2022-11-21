<?php

return [
    '/' => 	['GET', 'UserController@index'],

    '/api' => [
        '/users' =>         ['GET', 'UserController@index'],
        '/user' => [
            '/{id:\d+}' =>  ['GET', 'UserController@show']
        ]
    ],

    '/signin' => [
            '/' => ['GET', 'SigninController@options'],
            '/{provider:\w+}' => [
                '/callout'  => ['GET', 'SigninController@callout'],
                '/callback'  => ['GET', 'SigninController@callback'],
            ]
        ]
];

?>