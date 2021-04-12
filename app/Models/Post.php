<?php

namespace App\Models;

use App\Scopes\Post\LangScope;
use App\Scopes\Post\StatusScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Post extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope(new StatusScope);
        static::addGlobalScope(new LangScope);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post_views()
    {
        return $this->hasOne(PostView::class);
    }

    public function scopeSearch($query, $q)
    {
        $query->where('title_' . App::currentLocale(), 'like', '%' . $q . '%')
            ->orWhere('body_' . App::currentLocale(), 'like', '%' . $q . '%');
    }

    public function scopeInActive($query)
    {
        $query->where('status', false);
    }
}
