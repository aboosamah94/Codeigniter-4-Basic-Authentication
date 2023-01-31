<?php

namespace App\Controllers;

class Signup extends BaseController
{
	private $model;

	public function __construct()
	{
		$this->model = new \App\Models\UserModel;
	}

	public function new()
	{
		return view("Signup/new");
	}

	public function success()
    {
		return view('Signup/success');
    }

	//--------------------------------------

    public function create()
    {
        $user = new \App\Entities\User($this->request->getPost());

		if ($this->model->insert($user)) {
			return redirect()->to('signup/success')
				->with('info', 'User created successfully');
		} else {
			return redirect()->back()
				->with('errors', $this->model->errors())
				->with('warning', 'Inviled DATA')
				->withInput();
		}

    }
    
}