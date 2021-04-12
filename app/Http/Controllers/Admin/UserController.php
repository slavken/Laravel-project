<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')
            ->latest()
            ->paginate(10);

        return view('home.admin.users.index', ['users' => $users]);
    }

    public function show(Request $request, User $user)
    {
        $this->authorize('update-users');

        $userPosts = $user->posts()
            ->latest()
            ->paginate(5, '*', 'post')
            ->appends($request->query());
        $userComments = $user->comments()
            ->with('post')
            ->latest()
            ->paginate(5, '*', 'comment')
            ->appends($request->query());

        return view('home.admin.users.show', [
            'user' => $user,
            'posts' => $userPosts,
            'comments' => $userComments
        ]);
    }

    public function edit(User $user)
    {
        $this->authorize('update-users');
        return view('home.admin.users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update-users');

        if ($user->name != $request->name)
            $request->validate([
                'name' => 'min:2|unique:users'
            ]);
        if ($user->email != $request->email)
            $request->validate([
                'email' => 'email|min:6|unique:users'
            ]);

        $user->update($request->only(['name', 'email']));

        return back()
            ->with('status', 'The user updated successfully!');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete-users');
        $user->delete();

        return redirect()
            ->route('users.index');
    }
}
