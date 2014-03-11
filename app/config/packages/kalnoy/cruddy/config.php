<?php return array(

    'brand' => 'App',

    'uri' => 'backend',

    'dashboard' => '@users',

    'permissions' => 'sentry',

    'auth_filter' => 'auth',

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
    ),
);