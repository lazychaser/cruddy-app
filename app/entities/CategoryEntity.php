<?php

use Kalnoy\Cruddy\Schema\BaseSchema;

class CategoryEntity extends BaseSchema {

    protected $model = 'Category';

    protected $titleAttribute = 'title';

    protected $filters = ['parent'];

    public function fields($schema)
    {
        $schema->increments('id');
        $schema->string('title')->required();
        $schema->slug('slug', 'title')->required();
        $schema->image('images')->many();
        $schema->relates('parent', 'categories');
        $schema->timestamps();
    }

    public function layout($l)
    {
        $l->row(
        [
            [ 'title', 'slug', 'parent' ],
            [ 4, 'created_at', 'updated_at' ],
        ]);

        $l->tab('Images', 'images');
    }

    public function columns($schema)
    {
        $schema->col('id');
        $schema->col('images')->format('Image');
        $schema->col('title');
        $schema->col('parent');
        $schema->col('updated_at');
    }

    public function files($repo)
    {
        $repo->uploads('images')->to('images/categories')->keepNames();
    }

    public function rules($validate)
    {
        $validate->rules(
        [
            'title' => 'required',
            'slug' => 'required',
        ]);
    }
}