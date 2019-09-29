<?php

return [
    'role_structure' => [
        'productowner' => [
            'admin' => 'r',
            'settings' => 'r,u',
            'moderators' => 'c,r,u,d',
            'roles' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'brands' => 'c,r,u,d',
            'messages' => 'c,r,u,d',
            'pages' => 'c,r,u,d',
            'slideshow' => 'c,r,u,d',
            'contactus' => 'c,r,u,d',
            'countries' => 'c,r,u,d',
            'systemlogs' => 'r,d',
            'notifications' => 'r,d',
        ],
        'superadministrator' => [
            'admin' => 'r',
            'settings' => 'r,u',
            'moderators' => 'c,r,u',
            'roles' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'brands' => 'c,r,u,d',
            'messages' => 'c,r,u,d',
            'pages' => 'c,r,u,d',
            'slideshow' => 'c,r,u,d',
            'contactus' => 'c,r,u,d',
            'countries' => 'c,r,u,d',
            'systemlogs' => 'r,d',
            'notifications' => 'r,d',
        ],
        'administrator' => [
            'admin' => 'r',
            'settings' => 'r',
            'moderators' => 'r',
            'users' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'brands' => 'c,r,u,d',
            'messages' => 'c,r,u,d',
            'pages' => 'c,r,u,d',
            'slideshow' => 'c,r,u,d',
            'contactus' => 'c,r,u,d',
            'systemlogs' => 'r',
            'notifications' => 'r,d',
        ],
    ],
    'permission_structure' => [
        /*'cru_user' => [
            'profile' => 'c,r,u'
        ],*/
    ],
    'permissions_map' => [
        'l' => 'login',
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
