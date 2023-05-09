<?php

namespace App\Models;

use App\Libraries\Token;

class UsersModel extends \CodeIgniter\Model
{
    protected $table = 'users';

    protected $allowedFields = ['username', 'name', 'email', 'password_hash', 'activation_hash', 'reset_hash', 'reset_expires_at', 'status', 'bio', 'profile_image'];

    protected $returnType = 'App\Entities\Users';

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'username' => 'required|alpha_numeric_space|min_length[3]|max_length[128]|is_unique[users.username]',
        'name' => 'required|min_length[3]|max_length[128]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
        'password_confirmation' => 'required|matches[password]',
    ];

    protected $validationMessages = [
        'username' => [
            'required' => 'Please enter a username',
            'alpha_numeric_space' => 'The username field may only contain alpha-numeric characters and spaces',
            'min_length' => 'The username field must be at least 3 characters in length',
            'max_length' => 'The username field cannot exceed 128 characters in length',
            'is_unique' => 'This username is already taken'
        ],
        'name' => [
            'required' => 'Please enter a name',
            'min_length' => 'The name field must be at least 3 characters in length',
            'max_length' => 'The name field cannot exceed 128 characters in length'
        ],
        'email' => [
            'required' => 'Please enter an email',
            'valid_email' => 'Please enter a valid email address',
            'is_unique' => 'This email address is already taken'
        ],
        'password' => [
            'required' => 'Please enter a password',
            'min_length' => 'The password field must be at least 6 characters in length'
        ],
        'password_confirmation' => [
            'required' => 'Please enter a password confirmation',
            'matches' => 'The password confirmation does not match'
        ]
    ];

    protected $beforeInsert = ['hashPassword'];

    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {

            $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

            unset($data['data']['password']);
            unset($data['data']['password_confirmation']);
        }

        return $data;
    }

    public function findByEmail($email)
    {
        return $this->where('email', $email)
            ->first();
    }

    public function disablePasswordValidation()
    {
        unset($this->validationRules['password']);
        unset($this->validationRules['password_confirmation']);
    }

    public function activateByToken($token)
    {
        $token = new Token($token);

        $token_hash = $token->getHash();

        $user = $this->where('activation_hash', $token_hash)
            ->first();

        if ($user !== null) {

            $user->activate();

            $this->protect(false)
                ->save($user);

        }
    }

    public function getUserForPasswordReset($token)
    {
        $token = new Token($token);

        $token_hash = $token->getHash();

        $user = $this->where('reset_hash', $token_hash)
            ->first();

        if ($user) {

            if ($user->reset_expires_at < date('Y-m-d H:i:s')) {

                $user = null;

            }
        }

        return $user;
    }

}