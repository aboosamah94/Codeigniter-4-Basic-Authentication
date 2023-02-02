<?php

namespace App\Controllers;

class Login extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new \App\Models\UserModel;
    }

    public function new ()
    {
        return view("Login/new");
    }


    //--------------------------------------

    public function create()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $auth = service('auth');

        if ($auth->login($email, $password)) {

            $redirect_url = session('redirect_url') ?? '';

            unset($_SESSION['redirect_url']);

            return redirect()->to($redirect_url)
                ->with('info', 'Login successful');

        } else {

            return redirect()->back()
                ->withInput()
                ->with('warning', 'Invalid login');
        }
    }

    public function delete()
    {
        service('auth')->logout();

        return redirect()->to('logout/message');
    }

    public function showLogoutMessage()
    {
        return redirect()->to('')
            ->with('info', 'Logout successful');
    }





}