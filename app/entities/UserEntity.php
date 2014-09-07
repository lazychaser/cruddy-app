<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
use Kalnoy\Cruddy\Schema\BaseSchema;
use Kalnoy\Cruddy\Service\Validation\FluentValidator;

class UserEntity extends BaseSchema {

    protected $model = 'User';

    protected $defaultOrder = 'full_name';

    protected $filters = ['groups', 'country', 'state'];

    protected $perPage = 5;

    public function fields($schema)
    {
        $schema->increments('id')->hide(false);
        $schema->bool('activated');
        $schema->string('first_name');
        $schema->string('last_name');
        $schema->relates('country', 'countries')->disable(self::WHEN_EXISTS)->required();
        $schema->relates('state', 'states')->constraintWith('country')->required();
        $schema->embed('address')->required();
        $schema->email('email')->required();
        $schema->password('password')->required();
        $schema->embed('throttle');
        $schema->relates('groups');
        $schema->code('permissions_string');
        $schema->datetime('last_login')->disable()->unique();
        $schema->timestamps();
    }

    public function layout($l)
    {
        $l->fieldset('Personal', function ($set)
        {
            $set->text('Enter some personal data.');

            $set->row([ 'first_name', 'last_name' ]);
            $set->row([ 'country', 'state' ]);

            $set->field('address');
        });

        $l->fieldset('Credentials', function ($set)
        {
            $set->row(
            [
                [ 'email', 'password', 'groups' ],
                [ 6, 'permissions_string' ],
            ]);
        });

        $l->tab('Throttle', 'throttle');

        $l->tab('Sys', [ 'id', 'last_login', 'created_at', 'updated_at' ]);
    }

    public function columns($schema)
    {
        $schema->col('id');
        
        $schema->compute('full_name', function ($model)
        {
            return $this->toString($model);

        })->clause(DB::raw('concat(ifnull(last_name, ""), ifnull(first_name, ""))'));

        $schema->col('email');
        $schema->col('groups');
        // $schema->col('trottle.suspended');
        $schema->col('address');
        $schema->col('updated_at');
        $schema->col('last_login');

        $schema->states(
        [
            'success' => function ($model)
            {
                return $model->activated;
            },
        ]);
    }

    public function rules($validate)
    {
        $validate->rules(
        [
            'email' => 'required|email|max:255',
            'first_name' => 'max:255',
            'last_name' => 'max:255',
            'address' => 'required',
        ]);

        $validate->create(
        [
            'password' => 'required',
        ]);
    }

    public function toString($model)
    {
        $components = [];

        if (!empty($model->last_name)) $components[] = $model->last_name;
        if (!empty($model->first_name)) $components[] = $model->first_name;

        return implode(' ', $components) ?: $model->email;
    }

    public function toArray()
    {
        return parent::toArray() +
        [
            'layout' =>
            [
                [
                    'method' => 'tab',

                    'items' =>
                    [
                        [
                            'method' => 'fieldset',
                            'title' => 'Name',

                            'items' =>
                            [
                                [
                                    'method' => 'row',
                                    'items' =>
                                    [
                                        [
                                            'method' => 'col',
                                            'span' => 6, 
                                            'items' =>
                                            [
                                                [ 'method' => 'field', 'field' => 'last_name' ],
                                            ],
                                        ],

                                        [
                                            'method' => 'col',
                                            'span' => 6,
                                            'items' =>
                                            [
                                                [ 'method' => 'field', 'field' => 'first_name' ],
                                            ],
                                        ],
                                    ],
                                ]
                            ],
                        ],

                        [
                            'method' => 'fieldset',
                            'title' => 'Credentials',

                            'items' =>
                            [
                                [
                                    'method' => 'row',
                                    'items' =>
                                    [
                                        [
                                            'method' => 'col',
                                            'span' => 5,
                                            'items' =>
                                            [
                                                [ 'method' => 'field', 'field' => 'activated' ],
                                                [ 'method' => 'field', 'field' => 'email' ],
                                                [ 'method' => 'field', 'field' => 'password' ],
                                                [ 'method' => 'field', 'field' => 'last_login' ],
                                            ],
                                        ],

                                        [
                                            'method' => 'col',
                                            'span' => 7,
                                            'items' =>
                                            [
                                                [ 'method' => 'field', 'field' => 'permissions_string' ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ]
                    ],
                ],

                [
                    'method' => 'tab',
                    'title' => 'Address',
                    'items' =>
                    [
                        [ 'method' => 'field', 'field' => 'address' ],
                    ],
                ],

                [
                    'method' => 'tab',
                    'title' => 'Throttle',
                    'items' =>
                    [
                        [ 'method' => 'field', 'field' => 'throttle' ],
                    ],
                ],
            ],
        ];
    }
}