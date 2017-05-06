<?php
return [
    'manageUsers' => [
        'type' => 2,
        'description' => 'Manage users',
    ],
    'createUser' => [
        'type' => 2,
        'description' => 'Create user',
    ],
    'updateUser' => [
        'type' => 2,
        'description' => 'Update user',
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'manageUsers',
            'createUser',
            'updateUser',
        ],
    ],
];
