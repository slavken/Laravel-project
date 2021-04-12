<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

class AdminService
{
    public object $posts;
    public object $users;
    public object $comments;
    public array $statistics;

    public function statistics(): void
    {
        $this->posts = Post::all();
        $this->users = User::all();
        $this->comments = Comment::all();

        $post = $user = $comment = [];
        $time = [
            'today' => Carbon::today(),
            'week' => Carbon::now()->subWeek(),
            'month' => Carbon::now()->subMonth(),
            'year' => Carbon::now()->subYear()
        ];

        $arr = [
            [&$post, &$this->posts],
            [&$user, &$this->users],
            [&$comment, &$this->comments]
        ];

        foreach ($time as $key => $val)
            foreach ($arr as $el)
                $el[0][$key] = $el[1]->where('created_at', '>=', $val)
                    ->count();

        $this->statistics['post'] = $post;
        $this->statistics['user'] = $user;
        $this->statistics['comment'] = $comment;
    }
}
