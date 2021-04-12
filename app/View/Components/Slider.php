<?php

namespace App\View\Components;

use App\Models\Slider as AppSlider;
use App\Services\CacheService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Slider extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->slider = Cache::tags('slider')->remember(App::currentLocale(), 1800, function () {
            return AppSlider::with('post')
                ->latest()
                ->limit(5)
                ->get();
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.slider', ['slider' => $this->slider]);
    }
}
