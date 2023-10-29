<?php

return [
    '/' => 	['GET', 'PageController@home'],

    '/api' => [
        '/users' =>         ['GET', 'UserController@index'],
        '/user' => [
            '/{id:\d+}' =>  ['GET', 'UserController@show']
        ],

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