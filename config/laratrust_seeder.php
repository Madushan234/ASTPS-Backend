<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'admin' => [
            'users' => 'c,u,s,l,d,v',
            'profile' => 'u,s,v',
        ],
        'agent' => [
            'profile' => 'u,s,v',
        ],
        'customer' => [
            'profile' => 'u,s,v',
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'u' => 'update',
        's' => 'search',
        'l' => 'list',
        'd' => 'delete',
        'v' => 'view',
    ],
];
