<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Models\Post;
use App\Services\CacheService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->page ?: 1;
        $key = CacheService::name($page);

        $posts = Cache::tags('posts')->remember($key, 300, function () {
            return Post::with(['categories', 'post_views'])
                ->withCount('comments')
                ->latest()
                ->paginate(20);
        });

        return new PostCollection($posts);
    }
}
