<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->{'title_' . App::currentLocale()},
            'body' => $this->{'body_' . App::currentLocale()},
            'views' => $this->post_views->views,
            'img' => $this->{'img_' . App::currentLocale()} ? asset($this->{'img_' . App::currentLocale()}) : asset('img/default.png'),
            'comments_count' => $this->comments_count,
            'categories' => $this->categories->map(function ($category) {
                return [
                    'name' => $category->{'name_' . App::currentLocale()}, 
                    'color' => $category->color,
                    'link' => route('category.show', $category->alias)
                ];
            }),
            'link' => route('post.show', $this->alias)
        ];
    }
}
