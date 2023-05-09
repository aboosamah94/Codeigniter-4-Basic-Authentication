<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissionModel extends Model
{
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['controller_name', 'description', 'role_id', 'list_all', 'list', 'add', 'edit', 'delete',];
    protected $returnType = 'App\Entities\Permission';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'controller_name' => 'required|max_length[255]',
        'description' => 'required|max_length[255]',
        'role_id' => 'required|integer',
    ];
    protected $validationMessages = [
        'controller_name' => [
            'required' => 'The controller name field is required.',
            'max_length' => 'The controller name field must not exceed 255 characters.',
        ],
        'description' => [
            'required' => 'The description field is required.',
            'max_length' => 'The description field must not exceed 255 characters.',
        ],
        'role_id' => [
            'required' => 'The role ID field is required.',
            'integer' => 'The role ID field must be an integer.',
        ],
    ];

}