<?php

use Kalnoy\Cruddy\Schema\BaseSchema;
use Kalnoy\Cruddy\Service\Validation\FluentValidator;

class TranslationEntity extends BaseSchema {

    protected $model = 'Translation';

    protected $titleAttribute = 'title';

    protected $defaultOrder = 'title';

    public function fields($s)
    {
        $s->increments('id');
        $s->enum('locale', [ 'en' => 'English', 'ru' => 'Russian' ])->required();
        $s->string('value')->required();
    }

    public function layout($l)
    {
        $l->row([ [ 8, 'value' ], 'locale' ]);
    }

    public function rules($v)
    {
        $v->always(
        [
            'locale' => 'required',
            'value' => 'required',
        ]);
    }
}