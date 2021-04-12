<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Post;
use App\Services\CategoryService;
use App\Services\Post\PostService;

class PostController extends Controller
{
    public function __construct(PostService $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        return view('posts.index');
    }

    public function create(CategoryService $category)
    {
        return view('posts.create', ['categories' => $category->all()]);
    }

    public function store(StoreRequest $request)
    {
        $this->post->create($request);

        return redirect()
            ->route('home.index')
            ->with('status', 'The post added successfully! Wait check');
    }

    public function show($alias)
    {
        $res = $this->post->get($alias);

        return view('posts.show', [
            'post' => $res->post,
            'comments' => $res->comments,
            'commentsCount' => $res->commentsCount,
            'randomPosts' => $res->randomPosts
        ]);
    }

    public function edit($id, CategoryService $category)
    {
        $post = $this->post->gates((int) $id);

        return view('posts.edit', [
            'post' => $post,
            'categories' => $category->all()
        ]);
    }

    public function update(UpdateRequest $request, $id)
    {
        $post = $this->post->gates((int) $id);
        $this->post->edit($request, $post);

        return back()
            ->with('status', 'The post is updated successfully!');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $this->post->delete($post);

        return redirect()
            ->route('main');
    }
}
