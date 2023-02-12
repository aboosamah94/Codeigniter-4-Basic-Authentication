<?php

namespace App\Models;

class UserModel extends \CodeIgniter\Model
{
    protected $table = 'user';
    
    protected $allowedFields = ['name', 'email', 'password', 'activation_hash'];
    
    protected $returnType = 'App\Entities\User';
    
    protected $useTimestamps = true;
    
    protected $validationRules = [
        'name' => 'required',
        'email' => 'required|valid_email|is_unique[user.email]',
        'password' => 'required|min_length[6]',
        'password_confirmation'=> 'required|matches[password]',
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
        $token_hash = hash_hmac('sha256', $token, $_ENV['HASH_SECRET_KEY']);
        
        $user = $this->where('activation_hash', $token_hash)
                     ->first();
                     
        if ($user !== null) {
            
            $user->activate();
            
            $this->protect(false)
                 ->save($user);
            
        }
    }
}
