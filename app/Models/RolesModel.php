<?php

namespace App\Models;

class RolesModel extends \CodeIgniter\Model
{
    protected $table = 'roles';

    protected $allowedFields = ['name', 'description', 'group'];

    protected $returnType = 'App\Entities\Role';

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'name' => 'required|alpha_dash|is_unique[roles.name]|max_length[255]',
        'description' => 'max_length[255]',
        'group' => 'alpha_dash|max_length[255]',
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'The role name field is required',
            'alpha_dash' => 'The role name field may only contain alpha-numeric characters, underscores, and dashes',
            'is_unique' => 'The role name field must be unique',
            'max_length' => 'The role name field cannot exceed 255 characters in length'
        ],
        'description' => [
            'max_length' => 'The role description field cannot exceed 255 characters in length'
        ],
        'group' => [
            'alpha_dash' => 'The role group field may only contain alpha-numeric characters, underscores, and dashes',
            'max_length' => 'The role group field cannot exceed 255 characters in length'
        ]
    ];
}
