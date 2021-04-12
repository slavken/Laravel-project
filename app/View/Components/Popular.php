<?php

namespace App\View\Components;

use App\Models\Post;
use App\Services\CacheService;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Popular extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $key = CacheService::name('popular');

        $this->posts = Cache::tags('hit')->remember($key, 60, function () {
            return Post::with('categories')
                ->join('post_views', 'post_views.post_id', 'posts.id')
                ->select('posts.*', 'post_views.views', 'post_views.views_today', 'post_views.weekly_views', 'post_views.created_at', 'post_views.updated_at')
                ->where('post_views.updated_at', '>=', Carbon::today())
                ->latest('post_views.views_today')
                ->limit(5)
                ->get();
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.popular', ['posts' => $this->posts]);
    }
}
