<?php

Route::get('/', function () {

    return Redirect::to('backend');
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