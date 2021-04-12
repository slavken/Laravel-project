<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\AddRequest;
use App\Http\Requests\Admin\Role\DeleteRequest;
use App\Http\Requests\Admin\Role\NameRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;

class RoleController extends Controller
{
    public function __construct(RoleService $role)
    {
        $this->middleware('can:roles');
        $this->role = $role;
    }

    public function index()
    {
        $roles = Role::with('permissions')
            ->paginate();

        return view('home.admin.roles.index', ['roles' => $roles]);
    }

    public function create()
    {
        return view('home.admin.roles.create', ['permissions' => Permission::all()]);
    }

    public function store(NameRequest $request, Role $role)
    {
        $this->role->change($request, $role);

        return redirect()
            ->route('roles.index')
            ->with('status', 'The role added successfully!');
    }

    public function show(Role $role)
    {
        $users = $role->users()
            ->paginate();

        return view('home.admin.roles.show', [
            'role' => $role, 
            'users' => $users
        ]);
    }

    public function edit(Role $role)
    {
        return view('home.admin.roles.edit', [
            'role' => $role, 
            'permissions' => Permission::all()
        ]);
    }

    public function update(NameRequest $request, Role $role)
    {
        $this->role->change($request, $role);

        return redirect()
            ->route('roles.index')
            ->with('status', 'The role updated successfully!');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()
            ->route('roles.index');
    }

    public function add(AddRequest $request, Role $role)
    {
        if ($request->isMethod('post')) {
            $user = User::where('name', $request->name)
                ->first();

            if (!$user)
                return back()
                    ->withErrors('User is not found');

            $check = $role->users()
                ->syncWithoutDetaching($user->id);

            if (!$check['attached'])
                return back()
                    ->withErrors('The user has already been added');

            return back()
                ->with('status', 'The user has been added successfully!');
        }

        return view('home.admin.roles.add', [
            'role' => $role, 
            'users' => User::all()
        ]);
    }

    public function delete(DeleteRequest $request, User $user)
    {
        $this->role->delete($request, $user);
        return back();
    }
}
