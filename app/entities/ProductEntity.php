<?php

use Kalnoy\Cruddy\Schema\BaseSchema;
use Kalnoy\Cruddy\Schema\Layout\Col;
use Kalnoy\Cruddy\Schema\Layout\Row;
use Kalnoy\Cruddy\Schema\Layout\TabPane;
use Kalnoy\Cruddy\Service\Validation\FluentValidator;

class ProductEntity extends BaseSchema {

    protected $model = 'Product';

    protected $titleAttribute = 'title';

    protected $defaultOrder = 'title';

    protected $filters = ['price', 'categories'];

    public function fields($schema)
    {
        $schema->increments('id');
        $schema->string('title');
        $schema->float('price')->append('$');
        $schema->enum('type', $this->getTypes())->prompt('Select type')->prepend('products.type');
        $schema->text('description');
        $schema->image('image');

        $schema->relates('categories', 'categories')->filterOptions(function ($q)
        {
            $q->whereNotNull('parent_id');
        });

        $schema->embed('parameters', 'product_parameters');

        $schema->timestamps();
    }

    public function layout($l)
    {
        $l->tab('Main', function (TabPane $tab)
        {
            $tab->row(function (Row $row)
            {
                $row->col(9, function (Col $col)
                {
                    $col->field('title');
                    $col->row([ 'price', 'type' ]);
                });

                $row->col(3, 'image');
            });

            $tab->field('description', 'categories');
        });

        $l->tab('Parameters', 'parameters');
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
        $schema->col('price');
        $schema->col('categories');
        $schema->col('updated_at');

        $schema->states(function ($model)
        {
            return $model->price == null ? 'danger' : '';
        });
    }

    public function rules($validate)
    {
        $validate->rules(
        [
            'title' => 'required',
            'price' => [ 'required', 'numeric' ],
        ]);
    }
}