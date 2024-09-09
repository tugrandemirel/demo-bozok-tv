<?php

namespace App\Http\Controllers\Admin\RoleAndPermission;

use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function index()
    {
        return view('admin.role-and-permission.permission.index');
    }
}
