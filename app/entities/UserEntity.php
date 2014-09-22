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
        $schema->relates('country', 'countries')->disable(self::WHEN_EXISTS);
        $schema->relates('state', 'states')->constraintWith('country');
        $schema->embed('address');
        $schema->email('email');
        $schema->password('password');
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

}