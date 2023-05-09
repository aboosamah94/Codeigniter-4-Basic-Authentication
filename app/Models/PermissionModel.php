<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissionModel extends Model
{
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['controller_name', 'description', 'role_id', 'resource', 'list_all', 'list', 'add', 'edit', 'delete',];
    
}