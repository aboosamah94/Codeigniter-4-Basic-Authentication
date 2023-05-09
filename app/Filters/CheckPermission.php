<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class CheckPermission implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $user = service('auth')->getCurrentUser();
    
        if (!$user || !$user->role_id) {
            $response = service('response');
            $response->setStatusCode(403);
            $response->setBody('You do not have permission to access that resource');
            return $response;
        }

        if ($user->is_admin) {
            return;
        }

        $controllerName = strtolower($request->uri->getSegment(1));
        $methodName = strtolower($request->uri->getSegment(2));

        $roleId = $user->role_id;

        $permissions = $this->getPermissionsByRoleAndController($roleId, $controllerName);

        if (!$permissions) {
            $response = service('response');
            $response->setStatusCode(403);
            $response->setBody('You do not have permission to access that resource');
            return $response;
        }

        if (!$permissions[$methodName]) {
            $response = service('response');
            $response->setStatusCode(403);
            $response->setBody('You do not have permission to access that resource');
            return $response;
        }

        // Allow access if the user has the required permissions
        return;
    }


    protected function getPermissionsByRoleAndController($roleId, $controllerName)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('permissions');
        $builder->select('list_all, list, add, edit, delete');
        $builder->where('role_id', $roleId);
        $builder->where('name', $controllerName);
        $permissions = $builder->get()->getRowArray();

        if ($permissions) {
            return $permissions;
        }

        // If no matching permissions found for the specified controller, return null
        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
