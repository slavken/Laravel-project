<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function __invoke($alias, CategoryService $service)
    {
        $category = Cache::tags('categories')
            ->remember(
                $alias,
                Carbon::now()->addDay(),
                fn() => $service->getByAlias($alias)
            );

        return view('category.index', [
            'category' => $category,
            'alias' => $alias
        ]);
    }
}
