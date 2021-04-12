<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CommentService
{
    public function create(Request $request, Post $post): void
    {
        $comment = new Comment();
        $parent = Comment::find($request->parent);

        $comment->post_id = $post->id;
        $comment->parent_id = $parent?->id;
        $comment->body = $request->body;
        $comment->user_id = $request->user()?->id;
        $comment->lang = App::currentLocale();

        $comment->save();

        CacheService::delete('comments', $post->id);
    }

    public function edit(Request $request, Comment $comment): void
    {
        $comment->body = $request->body;
        $comment->save();
    }

    public function delete(Comment $comment): void
    {
        $comment->delete();
        CacheService::delete('comments', $comment->post_id);
    }

    public function confirm(int $id): void
    {
        $comment = Comment::inActive()
            ->findOrFail($id);
        $comment->status = true;

        $comment->save();

        CacheService::delete('comments', $comment->post->id);
    }

    public function latest(User $user): object
    {
        return $user->comments()
            ->with('post')
            ->latest()
            ->limit(3)
            ->get();
    }
}
