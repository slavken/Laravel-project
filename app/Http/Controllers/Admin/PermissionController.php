<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Permission\NameRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Services\PermissionService;

class PermissionController extends Controller
{
    public function __construct(PermissionService $permission)
    {
        $this->permission = $permission;
    }

    public function index()
    {
        $permissions = Permission::with('roles')
            ->paginate();

        return view('home.admin.permissions.index', ['permissions' => $permissions]);
    }

    public function create()
    {
        return view('home.admin.permissions.create', ['roles' => Role::all()]);
    }

    public function store(NameRequest $request, Permission $permission)
    {
        $this->permission->change($request, $permission);

        return redirect()
            ->route('permissions.index')
            ->with('status', 'The permission added successfully!');
    }

    public function edit(Permission $permission)
    {
        return view('home.admin.permissions.edit', [
            'permission' => $permission, 
            'roles' => Role::all()
        ]);
    }

    public function update(NameRequest $request, Permission $permission)
    {
        $this->permission->change($request, $permission);

        return redirect()
            ->route('permissions.index')
            ->with('status', 'The permission updated successfully!');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()
            ->route('permissions.index');
    }
}
