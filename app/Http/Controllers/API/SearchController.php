<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SearchCollection;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->q) {
            $posts = Post::with('categories')
                ->withCount('comments')
                ->search($request->q)
                ->join('post_views', 'post_views.post_id', 'posts.id')
                ->latest('post_views.views')
                ->limit(5)
                ->get();

            return new SearchCollection($posts);
        }

        return response()
            ->json(['message' => 'Query was empty'], 403);
    }
}
