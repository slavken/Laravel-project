<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Post;
use App\Services\CacheService;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Trending extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $weekName = CacheService::name('week');
        $trendingName = CacheService::name('trending');
        $interestingName = CacheService::name('interesting');

        $this->week = Cache::tags('hit')->remember($weekName, 60, function () {
            return Post::join('post_views', 'post_views.post_id', 'posts.id')
                ->where('post_views.updated_at', '>=', Carbon::now()->startOfWeek())
                ->latest('post_views.weekly_views')
                ->limit(4)
                ->get();
        });

        $this->trending = Cache::tags('hit')->remember($trendingName, 60, function () {
            return Category::all()
                ->random()
                ->posts()
                ->latest()
                ->limit(4)
                ->get();
        });

        $this->interesting = Cache::tags('hit')->remember($interestingName, 60, function () {
            return Post::join('post_views', 'post_views.post_id', 'posts.id')
                ->latest('post_views.views')
                ->limit(4)
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
        return view('components.trending', [
            'week' => $this->week,
            'trending' => $this->trending,
            'interesting' => $this->interesting
        ]);
    }
}
