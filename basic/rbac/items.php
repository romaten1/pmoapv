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
    'updateTeacherNews' => [
        'type' => 2,
        'description' => 'Update TeacherNews',
    ],
    'moderator' => [
        'type' => 1,
        'description' => 'Moderator',
        'children' => [
            'adminNews',
            'updateOwnMetodychka',
            'updateOwnTeacherNews',
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
    'updateOwnTeacherNews' => [
        'type' => 2,
        'description' => 'Update own TeacherNews',
        'ruleName' => 'isTeacherNewsAuthor',
        'children' => [
            'updateTeacherNews',
        ],
    ],
    'admin' => [
        'type' => 1,
        'description' => 'Administrator',
        'children' => [
            'updateMetodychka',
            'updateTeacherNews',
            'moderator',
            'adminUsers',
        ],
    ],
];
