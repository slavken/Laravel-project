<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Services\CommentService;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct(CommentService $comment)
    {
        $this->comment = $comment;
    }

    public function index()
    {
        $comments = Comment::with('post')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('home.comments', ['comments' => $comments]);
    }

    public function store(CommentRequest $request, Post $post)
    {
        $this->comment->create($request, $post);
        return back();
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $this->comment->delete($comment);

        return back();
    }
}
