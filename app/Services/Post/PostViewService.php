<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Models\PostView;
use App\Services\CacheService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class PostViewService
{
    protected Post $post;
    protected PostView $postViews;
    protected int $views;
    protected int $viewsToday;
    protected int $weeklyViews;
    protected string $viewsName;
    protected string $viewsNowName;
    protected string $viewsTodayName;
    protected string $weeklyViewsName;

    public function __construct(Post $post)
    {
        $this->post = $post;
        $this->postViews = $post->post_views;

        $this->cacheKeys();
        $this->views();
    }

    protected function views(): void
    {
        $num = rand(11, 20);

        $this->views = $this->getViewsCache();
        $this->viewsToday = $this->getViewsTodayCache();
        $this->weeklyViews = $this->getWeeklyViewsCache();

        $this->addView($num);
        $this->addViewToday($num);
        $this->addWeeklyView($num);
    }

    protected function getViewsCache(): string
    {
        return CacheService::value($this->viewsName, 0, Carbon::now()->addMonth());
    }

    protected function getViewsTodayCache(): string
    {
        return CacheService::value($this->viewsTodayName, 0, Carbon::now()->addDay());
    }

    protected function getWeeklyViewsCache(): string
    {
        return CacheService::value($this->weeklyViewsName, 0, Carbon::now()->addWeek());
    }

    protected function resetViewsToday(): void
    {
        $tmp = $this->postViews();

        if ($tmp) {
            $tmp->post_views->views_today = 0;
            $tmp->post_views->save();
        }
    }

    protected function resetWeeklyViews(): void
    {
        $tmp = $this->postViews();

        if ($tmp) {
            $tmp->post_views->weekly_views = 0;
            $tmp->post_views->save();
        }
    }

    protected function postViews(): Post
    {
        return Post::with('post_views')
            ->where('alias', $this->post->alias)
            ->first();
    }

    protected function addView(int $num): void
    {
        CacheService::value($this->viewsNowName, $this->postViews->views, 600);

        if ($this->views >= $num) {
            $this->postViews->increment('views', $this->views);

            Cache::increment($this->viewsNowName, $this->views);
            Cache::forget($this->viewsName);
        }

        Cache::increment($this->viewsName);
    }

    protected function addViewToday(int $num): void
    {
        if ($this->postViews->updated_at >= Carbon::today()) {
            if ($this->viewsToday >= $num) {
                $this->postViews->increment('views_today', $this->viewsToday);
                Cache::forget($this->viewsTodayName);
            }

            Cache::increment($this->viewsTodayName);
        } else {
            $this->resetViewsToday();
        }
    }

    protected function addWeeklyView(int $num): void
    {
        if ($this->postViews->updated_at >= Carbon::now()->startOfWeek()) {
            if ($this->weeklyViews >= $num) {
                $this->postViews->increment('weekly_views', $this->weeklyViews);
                Cache::forget($this->weeklyViewsName);
            }

            Cache::increment($this->weeklyViewsName);
        } else {
            $this->resetWeeklyViews();
        }
    }

    protected function cacheKeys(): void
    {
        $this->viewsName = CacheService::globalName('views', $this->post->id);
        $this->viewsNowName = CacheService::globalName('views_now', $this->post->id);
        $this->viewsTodayName = CacheService::globalName('views_today', $this->post->id);
        $this->weeklyViewsName = CacheService::globalName('weekly_views', $this->post->id);
    }
}
