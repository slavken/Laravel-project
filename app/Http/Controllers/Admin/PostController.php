<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Slider;
use App\Services\Post\PostService;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'post_views'])
            ->latest()
            ->paginate(10);
        $slider = Slider::with('post')
            ->latest()
            ->get();

        return view('home.admin.posts', [
            'posts' => $posts, 
            'slider' => $slider
        ]);
    }

    public function confirm($id, PostService $service)
    {
        $this->authorize('admin');
        $service->confirm((int) $id);

        return redirect()
            ->route('admin.dashboard');
    }

    public function delete($id, PostService $service)
    {
        $this->authorize('admin');

        $post = $service->getPostWithoutScopes((int) $id);
        $service->delete($post);

        return redirect()
            ->route('admin.dashboard');
    }
}
