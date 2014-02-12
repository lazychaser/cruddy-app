<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
use Kalnoy\Cruddy\Schema\BaseSchema;
use Kalnoy\Cruddy\Service\Validation\FluentValidator;

class UserEntity extends BaseSchema {

    protected $model = 'User';

    protected $defaultOrder = 'full_name';

    public function fields($schema)
    {
        $schema->increments('id');
        $schema->bool('activated');
        $schema->string('first_name');
        $schema->string('last_name');
        $schema->inline('address');
        $schema->email('email')->required();
        $schema->password('password')->required();
        $schema->inline('throttle');
        $schema->relates('groups');
        $schema->code('permissions_string');
        $schema->datetime('last_login')->unique();
        $schema->timestamps();
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
        $schema->col('updated_at');
        $schema->col('last_login');
    }

    public function rules($validate)
    {
        $validate->rules(
        [
            'email' => 'required|email|max:255',
            'first_name' => 'max:255',
            'last_name' => 'max:255',
        ]);

        $validate->create(
        [
            'password' => 'required',
        ]);
    }

    public function toString(Eloquent $model)
    {
        $components = [];

        if (!empty($model->last_name)) $components[] = $model->last_name;
        if (!empty($model->first_name)) $components[] = $model->first_name;

        return implode(' ', $components) ?: $model->email;
    }
}