<?php
return [
    'adminNews' => [
        'type' => 2,
        'description' => 'Administrate news, staticPages, predmets, metodychkies',
    ],
    'adminUsers' => [
        'type' => 2,
        'description' => 'Administrate users and teachers',
    ],
    'moderator' => [
        'type' => 1,
        'description' => 'Moderator',
        'children' => [
            'adminNews',
        ],
    ],
    'admin' => [
        'type' => 1,
        'description' => 'Administrator',
        'children' => [
            'moderator',
            'adminUsers',
        ],
    ],
];
