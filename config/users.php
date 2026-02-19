<?php

return [
    'main' => [
        'name'       => env('USER_NAME', 'Mesh'),
        'email'      => env('USER_EMAIL', 'mesh@gmail.com'),
        'password'   => env('USER_PASSWORD', 'password'),
    ],
    'demo' => [
        'name'       => env('USER_DEMO_NAME', 'Demo'),
        'email'      => env('USER_DEMO_EMAIL', 'demo@example.com'),
        'password'   => env('USER_DEMO_PASSWORD', 'demo'),
    ],
];
