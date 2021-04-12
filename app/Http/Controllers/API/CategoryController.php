<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Services\CacheService;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index(Request $request, $alias, CategoryService $service)
    {
        $page = $request->page ?: 1;
        $key = CacheService::name('categories', $alias, $page);

        $posts = Cache::tags('posts')->remember($key, 3600, function () use ($alias, $service) {
            $category = $service->getByAlias($alias);

            return $category->posts()
                ->with('categories')
                ->latest()
                ->paginate(20);
        });

        return new PostCollection($posts);
    }
}
