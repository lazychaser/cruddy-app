<?php

Route::get('/', function () {

    return redirect('backend');
});

Route::get('login', 'UsersController@login');
Route::get('logout', 'UsersController@logout');
Route::post('login', 'UsersController@authenticate');

Route::get('backend/custom_page', 'BackendController@customPage');

Route::get('select/{entity}', ['before' => 'backend.auth', function ($entity) {

    $entity = app('Kalnoy\Cruddy\Environment')->entity($entity);

    return View::make('search', compact('entity'));
}]);

Route::get('sandbox/ace', function ()
{
    return View::make('sandbox.ace');
});

Route::get('sandbox/layout', function ()
{
    $l = new Kalnoy\Cruddy\Schema\Layout\Layout;

    $l->tab('Tab 1', function ($tab)
    {
        $tab->fieldset('Fieldset 1', [ 'first_name', 'last_name' ]);

        $tab->row([ 'row_1', 'row_2' ]);

        $tab->row(function ($row)
        {
            $row->col(6, [ 'col_1', [ 'col_2' ]]);
            $row->col(6, 'col_3');
        });
    });

    return $l->compileItems();
});