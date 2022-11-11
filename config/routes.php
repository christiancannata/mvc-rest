<?php

return [
    [
        'method' => 'GET',
        'uri' => '/api/users',
        'controller' => \Christiancannata\PhpApi\Controllers\UserController::class,
        'action' => 'index'
    ],
    [
        'method' => 'POST',
        'uri' => '/api/users',
        'controller' => \Christiancannata\PhpApi\Controllers\UserController::class,
        'action' => 'store'
    ],
    [
        'method' => 'GET',
        'uri' => '/api/users/{id}',
        'controller' => \Christiancannata\PhpApi\Controllers\UserController::class,
        'action' => 'show'
    ],
    [
        'method' => 'PATCH',
        'uri' => '/api/users/{id}',
        'controller' => \Christiancannata\PhpApi\Controllers\UserController::class,
        'action' => 'update'
    ],
    [
        'method' => 'DELETE',
        'uri' => '/api/users/{id}',
        'controller' => \Christiancannata\PhpApi\Controllers\UserController::class,
        'action' => 'delete'
    ]
];