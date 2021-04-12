<?php

namespace App\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class CacheService
{
    private const SEPARATOR = ':';

    public function values(): array
    {
        return [
            'categories' => 'index',
            'slider' => App::currentLocale(),
            'posts' => App::currentLocale()
        ];
    }

    public function forgetTags(string | array $tags, string $key): bool
    {
        if (!Cache::tags($tags)->has($key))
            return false;

        Cache::tags($tags)->forget($key);
        return true;
    }

    public function deletePosts(): void
    {
        Cache::tags(['posts', 'random', 'hit'])
            ->flush();
    }

    public static function value(string $key, $value, $time = 0)
    {
        if (!Cache::has($key))
            Cache::put($key, $value, $time);

        return Cache::get($key);
    }

    public static function name(...$arr): string
    {
        array_unshift($arr, App::currentLocale());
        return self::generateKey($arr);
    }

    public static function globalName(...$arr): string
    {
        return self::generateKey($arr);
    }

    public static function delete($key, $val): void
    {
        Cache::forget(self::name($key, $val));
    }

    protected static function generateKey($arr): string
    {
        return implode(self::SEPARATOR, $arr);
    }
}
