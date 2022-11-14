<?php

return [
    [
        'method' => 'POST',
        'uri' => '/api/login',
        'controller' => \Christiancannata\PhpApi\Controllers\LoginController::class,
        'action' => 'doLogin',
        'auth' => false
    ],
    [
        'method' => 'GET',
        'uri' => '/api/users',
        'controller' => \Christiancannata\PhpApi\Controllers\UserController::class,
        'action' => 'index',
        'auth' => true
    ],
    [
        'method' => 'POST',
        'uri' => '/api/users',
        'controller' => \Christiancannata\PhpApi\Controllers\UserController::class,
        'action' => 'store',
        'auth' => true
    ],
    [
        'method' => 'GET',
        'uri' => '/api/users/{id}',
        'controller' => \Christiancannata\PhpApi\Controllers\UserController::class,
        'action' => 'show',
        'auth' => true
    ],
    [
        'method' => 'PATCH',
        'uri' => '/api/users/{id}',
        'controller' => \Christiancannata\PhpApi\Controllers\UserController::class,
        'action' => 'update',
        'auth' => true
    ],
    [
        'method' => 'DELETE',
        'uri' => '/api/users/{id}',
        'controller' => \Christiancannata\PhpApi\Controllers\UserController::class,
        'action' => 'delete',
        'auth' => true
    ]
];