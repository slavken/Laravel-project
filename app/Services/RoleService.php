<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleService
{
    public function change(Request $request, Role $role): void
    {
        $role->name = Str::lower($request->name);

        $role->save();
        $role->permissions()
            ->sync($request->permission);
    }

    public function delete(Request $request, User $user): void
    {
        $user->roles()
            ->detach($request->role);
    }
}
