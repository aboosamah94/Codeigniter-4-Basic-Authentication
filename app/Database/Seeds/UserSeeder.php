<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $model = new \App\Models\UsersModel;

        $data = [
            'username' => 'admin',
            'name'     => 'Admin',
            'email'    => 'admin@demo.com',
            'password' => '12345678',
            'is_admin' => true,
            'is_active' => true
        ];

        $model->skipValidation(true)
            ->protect(false)
            ->insert($data);

        dd($model->errors());
    }
}