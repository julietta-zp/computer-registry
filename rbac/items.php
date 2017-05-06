<?php
return [
    'login' => [
        'type' => 2,
    ],
    'logout' => [
        'type' => 2,
    ],
    'error' => [
        'type' => 2,
    ],
    'sign-up' => [
        'type' => 2,
    ],
    'index' => [
        'type' => 2,
    ],
    'view' => [
        'type' => 2,
    ],
    'create' => [
        'type' => 2,
    ],
    'update' => [
        'type' => 2,
    ],
    'delete' => [
        'type' => 2,
    ],
    'manageUsers' => [
        'type' => 2,
    ],
    'user' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'guest',
            'index',
            'view',
        ],
    ],
    'admin' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'user',
            'create',
            'update',
            'delete',
            'manageUsers',
        ],
    ],
    'guest' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'login',
            'logout',
            'error',
            'sign-up',
        ],
    ],
];
