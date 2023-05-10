<?php

if (!function_exists('hasPermission')) {
    function hasPermission($controllerName, $permissionType)
    {
        $user = service('auth')->getCurrentUser();

        if ($user->is_admin) {
            return true;
        }

        $permissionModel = new \App\Models\PermissionModel;
        $userRoleId = $user->role_id;

        $permission = $permissionModel
            ->where('controller_name', $controllerName)
            ->where('role_id', $userRoleId)
            ->first();

        if (!$permission || !$permission->$permissionType) {
            return false;
        }

        return true;
    }
}


if (!function_exists('checkPermission')) {
    function checkPermission($controllerName, $permissionType)
    {
        if (!hasPermission($controllerName, $permissionType)) {
            echo view('errors/html/error_403');
            header('Refresh:5; url=' . base_url('dashboard'));
            session()->setFlashdata('warning', 'You don\'t have permission to access this page.');
            exit;
        }
    }
}