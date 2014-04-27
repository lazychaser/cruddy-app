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
    ),

    'menu' =>
    [
        [
            'label' => 'Dashboard',
            'url' => 'backend/custom_page',
            'icon' => 'dashboard',
        ],

        '-',

        'Store' =>
        [
            [ 'entity' => 'products', 'label' => 'Products (custom)', 'icon' => 'usd' ],
            '-',
            'categories',
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