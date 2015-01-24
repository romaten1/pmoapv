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
    'updateMetodychka' => [
        'type' => 2,
        'description' => 'Update Metodychka',
    ],
    'moderator' => [
        'type' => 1,
        'description' => 'Moderator',
        'children' => [
            'adminNews',
            'updateOwnMetodychka',
        ],
    ],
    'updateOwnMetodychka' => [
        'type' => 2,
        'description' => 'Update own Metodychka',
        'ruleName' => 'isAuthor',
        'children' => [
            'updateMetodychka',
        ],
    ],
    'admin' => [
        'type' => 1,
        'description' => 'Administrator',
        'children' => [
            'updateMetodychka',
            'moderator',
            'adminUsers',
        ],
    ],
];
