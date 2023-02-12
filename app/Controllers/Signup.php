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

    public function activate($token)
    {
        $model = new \App\Models\UserModel;
        
        $model->activateByToken($token);
        
		return view('Signup/activated');
    }
	
	//--------------------------------------

    public function create()
    {
        $user = new \App\Entities\User($this->request->getPost());

        $user->startActivation();
        
        if ($this->model->insert($user)) {
            
            $this->sendActivationEmail($user);
        
            return redirect()->to('signup/success');
            
        } else {
            
            return redirect()->back()
                             ->with('errors', $this->model->errors())
                             ->with('warning', 'Invalid data')
                             ->withInput();
        }
    }

    private function sendActivationEmail($user)
    {
        $email = service('email');

        $email->setTo($user->email);

        $email->setSubject('Account activation');

        $message = view('Signup/activation_email', [
			'username' => $user->name,
            'token' => $user->token
        ]);

        $email->setMessage($message);

        $email->send();
    }
    
}