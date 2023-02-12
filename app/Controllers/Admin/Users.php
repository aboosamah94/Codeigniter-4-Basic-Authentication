<?php

namespace App\Controllers\Admin;

use App\Entities\User;

class Users extends \App\Controllers\BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new \App\Models\UserModel;
    }

    public function index()
    {
        $users = $this->model->orderBy('id')
            ->paginate(5);

        return view('Admin/Users/index', [
            'users' => $users,
            'pager' => $this->model->pager
        ]);
    }

    public function show($id)
    {
        $user = $this->getUserOr404($id);

        return view('Admin/Users/show', [
            'user' => $user
        ]);
    }

    public function new ()
    {
        $user = new User;

        return view('Admin/Users/new', [
            'user' => $user
        ]);
    }

    public function edit($id)
    {
        $user = $this->getUserOr404($id);

        return view('Admin/Users/edit', [
            'user' => $user
        ]);
    }

	//--------------------------------------

	public function create()
	{
		$user = new User($this->request->getPost());

		if ($this->model->protect(false)->insert($user)) {

            $this->sendemail($user);
			return redirect()->to('dashboard/users/' . $this->model->insertID)
				->with('info', 'User created successfully');
		} else {
			return redirect()->back()
				->with('errors', $this->model->errors())
				->with('warning', 'Inviled DATA')
				->withInput();
		}

	}

    private function sendemail($user)
    {
        $email = service('email');

        $email->setTo($user->email);

        $email->setSubject('Account activation');

        $message = view('Admin/Users/activation_email', [
			'username' => $user->name,
            'useremail' => $user->email,
            'userpass' => $user->password,
            'is_active' => $user->is_active,
        ]);

        $email->setMessage($message);

        $email->send();
    }

    public function update($id)
    {
        $user = $this->getUserOr404($id);

        $post = $this->request->getPost();

        if (empty($post['password'])) {

            $this->model->disablePasswordValidation();

            unset($post['password']);
            unset($post['password_confirmation']);
        }

        $user->fill($post);

        if (!$user->hasChanged()) {

            return redirect()->back()
                ->with('warning', 'Nothing to update')
                ->withInput();
        }

        if ($this->model->protect(false)->save($user)) {

            return redirect()->to('dashboard/users/' . $id)
                ->with('info', 'User updated successfully');

        } else {

            return redirect()->back()
                ->with('errors', $this->model->errors())
                ->with('warning', 'Invalid data')
                ->withInput();

        }
    }


    public function delete($id)
    {
        $user = $this->getUserOr404($id);
        if ($this->model->delete(['id' => $id])) {
            return redirect()->to('dashboard/users')
                ->with('info', 'User Deleted successfully');
        } else {
            return redirect()->back()
                ->with('errors', $this->model->errors())
                ->with('warning', 'Inviled DATA');
        }
    }



    private function getUserOr404($id)
    {
        $user = $this->model->where('id', $id)
            ->first();

        if ($user === null) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException("User with id $id not found");

        }

        return $user;
    }
}