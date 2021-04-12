<?php

namespace App\Http\Controllers;

use App\Http\Requests\Update\EmailRequest;
use App\Http\Requests\Update\PasswordRequest;
use App\Http\Requests\Update\UsernameRequest;
use App\Scopes\Post\StatusScope;
use App\Services\CommentService;
use App\Services\Post\PostService;
use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(Request $request, PostService $post, CommentService $comment)
    {
        $user = $request->user();
        $latestPosts = $post->latest($user);
        $latestComments = $comment->latest($user);
        $qtyPosts = $user->posts->count();
        $qtyComments = $user->comments->count();
        $waitingPosts = $user->posts()
            ->withoutGlobalScope(StatusScope::class)
            ->inActive()
            ->latest()
            ->get();

        return view('home.index', [
            'latestPosts' => $latestPosts, 
            'latestComments' => $latestComments, 
            'qtyPosts' => $qtyPosts, 
            'qtyComments' => $qtyComments,
            'waitingPosts' => $waitingPosts
        ]);
    }

    public function posts(Request $request)
    {
        $posts = $request->user()
            ->posts()
            ->latest()
            ->paginate(10);

        return view('home.posts', ['posts' => $posts]);
    }

    public function settings()
    {
        return view('home.settings');
    }

    public function updateEmail(EmailRequest $request, UserService $user)
    {
        if ($request->isMethod('post')) {
            $user->updateEmail($request, $request->user());
            event(new Registered($request->user()));

            return back();
        }

        return view('home.update.email');
    }

    public function updateUsername(UsernameRequest $request, UserService $user)
    {
        if ($request->isMethod('post')) {
            $user->updateUsername($request, $request->user());

            return redirect()
                ->route('home.settings')
                ->with('status', 'The username changed successfully!');
        }

        return view('home.update.username');
    }

    public function updatePassword(PasswordRequest $request, UserService $user)
    {
        if ($request->isMethod('post')) {
            if (Hash::check($request->old_password, $request->user()->password)) {
                $user->updatePassword($request, $request->user());

                return redirect()
                    ->route('home.settings')
                    ->with('status', 'Password changed successfully!');
            }

            return back()
                ->withErrors('The old password is incorrect');
        }

        return view('home.update.password');
    }
}
