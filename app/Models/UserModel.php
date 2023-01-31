<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';

    protected $allowedFields = ['name', 'email', 'password'];

    protected $returnType = 'App\Entities\User';

    protected $useTimestamps = true;

    protected $beforeInsert = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (! isset($data['data']['password'])) {
            return $data;
        }

        $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        unset($data['data']['password']);

        return $data;
    }


    protected $validationRules = [
        'name' => 'required',
        'email' => 'required|valid_email|is_unique[user.email]',
        'password' => 'required|min_length[6]',
        'password_confirmation' => 'required|matches[password]'
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Please enter a Name'
        ],
        'email' => [
            'required' => 'Please enter an Email',
            'valid_email' => 'Please enter a Ture Email address',
            'is_unique' => 'This email address is taken'
        ],
        'password' => [
            'required' => 'Please enter a Password',
            'min_length' => 'Please enter a Password at least 6 characters'
        ],
        'password_confirmation' => [
            'required' => 'Please enter a password confirmation',
            'matches' => 'Please enter a password matches'
        ]
    ];

    public function findByEmail($email)
    {
        return $this->where('email', $email)
                    ->first();
    }

}