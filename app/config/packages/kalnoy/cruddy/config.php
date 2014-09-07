<?php return array(

    'brand' => 'Test App',

    'uri' => 'backend',

    'dashboard' => '@users',

    'permissions' => 'sentry',

    'auth_filter' => 'auth',

    'logout_url' => url('logout'),

    'layout' => 'cruddy::layout',

    'assets' => 'cruddy/public',

    'entities' => array(
        'users' => 'UserEntity',
        'groups' => 'GroupEntity',
        'addresses' => 'AddressEntity',
        'products' => 'ProductEntity',
        'categories' => 'CategoryEntity',
        'throttles' => 'ThrottleEntity',
        'parameters' => 'ParameterEntity',
        'product_parameters' => 'ProductParameterEntity',
        'countries' => 'CountryEntity',
        'states' => 'StateEntity',
        'translations' => 'TranslationEntity',
    ),

    'menu' =>
    [
        '-',
        
        [
            'label' => 'Dashboard',
            'url' => 'backend/custom_page',
            'icon' => 'dashboard',
        ],

        '-',

        [
            'label' => 'tore',
            'icon' => 'usd',

            'items' =>
            [
                [
                    'entity' => 'products',
                    'label' => 'Products (custom label)',
                ],
                
                '-',

                [
                    'label' => 'Test the permissions.', 
                    'href' => '#test', 
                    'permissions' => function () { return false; },
                ],
                
                '-',
                
                'categories',

                '-',
            ],

            'data-foo' => 'bar',
        ],

        'countries',

        'backend.auth' =>
        [
            'users',
            'groups',
        ],
    ],

    'service_menu' =>
    [
        [ 'label' => 'Logout', 'url' => 'logout', 'icon' => 'log-out' ],
    ],
);