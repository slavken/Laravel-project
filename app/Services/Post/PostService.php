<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Models\User;
use App\Scopes\Post\StatusScope;
use App\Services\CacheService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostService
{
    public Post $post;
    public object $comments;
    public int $commentsCount;
    protected CacheService $cache;
    protected string $locale;

    public function __construct(CacheService $cache)
    {
        $this->cache = $cache;
        $this->locale = App::currentLocale();
    }

    public function create(Request $request): void
    {
        $post = new Post();
        $post->user_id = $request->user()->id;
        $post->alias = Str::slug($request->title);

        $this->setParams($request, $post);
        $post->save();
        $post->categories()
            ->attach($request->category);
        $post->post_views()
            ->create();
    }

    public function get(string $alias): PostService
    {
        $this->post($alias);
        $this->comments();
        $this->random();

        new PostViewService($this->post);

        return $this;
    }

    public function edit(Request $request, Post $post): void
    {
        $alias = $post->alias;

        if ($post->{'title_' . $this->locale} !== $request->title)
            $request->validate(['title' => 'unique:posts,title_' . $this->locale]);
        if ($this->locale === 'en')
            $post->alias = Str::slug($request->title);

        $this->setParams($request, $post);
        $post->save();
        $post->categories()
            ->sync($request->category);

        $this->cache->delete('post', $alias);
        $this->cache->deletePosts();
    }

    public function delete(Post $post): void
    {
        $post->delete();
        $this->cache->delete('post', $post->alias);
        $this->cache->deletePosts();
    }

    public function confirm(int $id)
    {
        $post = Post::withoutGlobalScopes()
            ->inActive()
            ->findOrFail($id);
        $post->status = true;

        $post->save();
        $this->cache->delete('post', $post->alias);
        $this->cache->deletePosts();
    }

    public function gates(int $id): Post
    {
        $post = $this->getPostWithoutScopes($id);

        if (Gate::none(['update', 'update-posts'], $post))
            abort(403);

        return $post;
    }

    protected function post(string $alias): void
    {
        $key = $this->cache->name('post', $alias);

        $this->post = Cache::remember($key, 600, function () use ($alias) {
            $post = Post::with(['categories', 'post_views'])
                ->where('alias', $alias)
                ->firstOrFail();
            $post->post_views->touch();

            return $post;
        });
    }

    public function latest(User $user): object
    {
        return $user->posts()
            ->latest()
            ->limit(3)
            ->get();
    }

    protected function random(): void
    {
        $key = $this->cache->name('posts', $this->post->id);

        $this->randomPosts = Cache::tags('random')->remember($key, 300, function () {
            return Post::inRandomOrder()
                ->limit(3)
                ->get();
        });
    }

    public function getPostWithoutScopes(int $id)
    {
        return Post::withoutGlobalScopes()
            ->findOrFail($id);
    }

    protected function comments(): void
    {
        $key = $this->cache->name('comments', $this->post->id);

        $comments = Cache::remember($key, 600, function () {
            return Post::find($this->post->id)
                ->comments()
                ->with('user')
                ->active()
                ->get();
        });

        $this->commentsCount = $comments->count();
        $this->comments = $comments->groupBy('parent_id');
    }

    public function waiting(): object
    {
        return Post::with('user')
            ->withoutGlobalScope(StatusScope::class)
            ->inActive()
            ->latest()
            ->paginate(5);
    }

    protected function setParams(Request $request, Post $post): void
    {
        $post->{'title_' . $this->locale} = $request->title;
        $post->{'body_' . $this->locale} = $request->body;

        if ($request->file('img'))
            $post->{'img_' . $this->locale} = Storage::put('images', $request->file('img'));
    }
}
