<?php

use App\Service\Form\UsersForm;

class UsersController {

	protected $form;

	public function __construct(UsersForm $form)
	{
		$this->form = $form;
	}

	public function login($redirect = null)
	{
		return view('users.login', compact('redirect'));
	}

	public function logout()
	{
		$this->form->logout();

		return redirect('/');
	}

	public function authenticate()
	{
		if ($this->form->authenticate(Input::only('email', 'password')))
		{
			$redirect = Input::get('redirect', '/');

			return Redirect::intended();
		}

		return redirect('login')->withErrors($this->form->errors())->withInput();
	}

}