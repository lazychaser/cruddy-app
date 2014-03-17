<?php

/**
 * BackendController
 */
class BackendController extends BaseController {

    protected $layout = "cruddy::layout";

    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    public function customPage()
    {
        $this->layout->content = 'Test content';
    }

}