<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Update\PasswordRequest;
use App\Http\Requests\Update\EmailRequest;
use App\Http\Requests\Update\UsernameRequest;
use App\Models\Category;
use App\Models\User;
use App\Services\AdminService;
use App\Services\Post\PostService;
use App\Services\UserService;
use Illuminate\Auth\Events\Registered;

class HomeController extends Controller
{
    public function __construct(UserService $user)
    {
        $this->user = $user;
    }

    public function index(AdminService $admin, PostService $post)
    {
        $admin->statistics();

        return view('home.admin.index', [
            'posts' => $admin->posts,
            'users' => $admin->users,
            'categories' => Category::all(),
            'comments' => $admin->comments,
            'topUsers' => $this->user->leaderboard(),
            'waitingPosts' => $post->waiting(),
            'datePost' => $admin->statistics['post'],
            'dateUser' => $admin->statistics['user'],
            'dateComment' => $admin->statistics['comment']
        ]);
    }

    public function updateEmail(EmailRequest $request, User $user)
    {
        $this->authorize('update-users');

        if ($request->isMethod('post')) {
            $user = $this->user->updateEmail($request, $user);
            event(new Registered($user));

            return redirect()
                ->route('users.show', $user->id)
                ->with('status', 'The email changed successfully!');
        }

        return view('home.admin.users.update.email', ['user' => $user]);
    }

    public function updateUsername(UsernameRequest $request, User $user)
    {
        $this->authorize('update-users');

        if ($request->isMethod('post')) {
            $user = $this->user->updateUsername($request, $user);

            return redirect()
                ->route('users.show', $user->id)
                ->with('status', 'The username changed successfully!');
        }

        return view('home.admin.users.update.username', ['user' => $user]);
    }

    public function updatePassword(PasswordRequest $request, User $user)
    {
        $this->authorize('update-users');

        if ($request->isMethod('post')) {
            $user = $this->user->updatePassword($request, $user);

            return redirect()
                ->route('users.show', $user->id)
                ->with('status', 'Password changed successfully!');
        }

        return view('home.admin.users.update.password', ['user' => $user]);
    }

    public function confirmEmail(User $user)
    {
        $this->authorize('update-users');
        $this->user->confirmEmail($user);

        return back();
    }
}
