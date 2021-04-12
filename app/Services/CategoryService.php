<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class CategoryService
{
    protected string $locale;

    public function __construct()
    {
        $this->locale = App::currentLocale();
    }

    public function all(): object
    {
        return Cache::tags('categories')->rememberForever('index', function () {
            return Category::all();
        });
    }

    public function create(Request $request): void
    {
        $category = new Category();

        foreach (Config::get('app.languages') as $lang)
            $category->{'name_' . $lang} = $request->name;

        $category->alias = Str::slug($request->name);
        $category->color = $request->color;

        $category->save();
        $this->clearCache();
    }

    public function edit(Request $request, Category $category): void
    {
        if ($category->{'name_' . $this->locale} != $request->name) {
            $request->validate([
                'name' => 'unique:categories,name_' . $this->locale
            ]);
        }

        $category->{'name_' . $this->locale} = $request->name;
        $category->color = $request->color;

        $category->save();
        $this->clearCache();
    }

    public function delete(Category $category): void
    {
        $category->delete();
        $this->clearCache();
    }

    public function getByAlias(string $alias)
    {
        return Category::where('alias', Str::slug($alias))
            ->firstOrFail();
    }

    protected function clearCache()
    {
        Cache::tags('categories')
            ->flush();
    }
}
