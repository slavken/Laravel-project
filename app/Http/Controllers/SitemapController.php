<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function index()
    {
        $posts = Cache::tags('posts')->remember(App::currentLocale(), 60, function () {
            return Post::all();
        });

        return response()
            ->view('sitemap.index', ['posts' => $posts])
            ->header('Content-Type', 'text/xml');
    }

    public function robots()
    {
        return response()
            ->view('sitemap.robots')
            ->header('Content-Type', 'text/plain');
    }
}
