<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CacheService;
use Illuminate\Support\Facades\Cache;

class CacheController extends Controller
{
    public function __construct(CacheService $cache)
    {
        $this->middleware('can:cache');
        $this->cache = $cache;
    }

    public function index()
    {
        return view('home.admin.cache.index', ['data' => $this->cache->values()]);
    }

    public function clear($name = null, $key = null)
    {
        if ($name && $key) {
            if (!$this->cache->forgetTags($name, $key))
                return back();

            return redirect()
                ->route('cache.index')
                ->with('status', 'Cache is empty! [' . $name . ']');
        }

        Cache::flush();

        return redirect()
            ->route('cache.index')
            ->with('status', 'Cache is empty!');
    }
}
