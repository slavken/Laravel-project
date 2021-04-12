<?php

namespace App\Services;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionService
{
    public function change(Request $request, Permission $permission)
    {
        $permission->name = Str::slug($request->name);
        $permission->save();
        $permission->roles()
            ->sync($request->role);
    }
}
