<?php

use Kalnoy\Cruddy\Schema\BaseSchema;
use Kalnoy\Cruddy\Service\Validation\FluentValidator;

class ProductEntity extends BaseSchema {

    protected $model = 'Product';

    protected $titleAttribute = 'title';

    protected $defaultOrder = 'title';

    public function fields($schema)
    {
        $schema->increments('id');
        $schema->string('title')->required();
        $schema->enum('type', $this->getTypes())->prompt('Please, select type');
        $schema->markdown('description');
        $schema->image('image');
        
        $schema->relates('categories', 'categories')->filterOptions(function ($q)
        {
            $q->whereNotNull('parent_id');
        });

        $schema->embed('parameters', 'product_parameters');
        $schema->timestamps();
    }

    public function getTypes()
    {
        return ['first' => 'First type', 'second' => 'Second type'];
    }

    public function files($repo)
    {
        $repo->uploads('image')->to('images/products')->keepNames();
    }

    public function columns($schema)
    {
        $schema->col('id');
        $schema->col('image')->format('Image');
        $schema->col('title');
        $schema->col('categories');
        $schema->col('updated_at');
    }

    public function rules($validate)
    {
        $validate->rules(
        [
            'title' => 'required',
        ]);
    }
}