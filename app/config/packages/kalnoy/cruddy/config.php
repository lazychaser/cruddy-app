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

    'menu' => array(
        'Store' => array(
            'products',
            'categories',
        ),

        'countries',

        'backend.auth' => array(
            'users',
            'groups',
        ),

        'Custom page' => url('backend/custom_page'),
    ),
);