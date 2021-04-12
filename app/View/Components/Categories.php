<?php

namespace App\View\Components;

use App\Services\CategoryService;
use Illuminate\View\Component;

class Categories extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(CategoryService $category)
    {
        $this->categories = $category->all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.categories', ['categories' => $this->categories]);
    }
}
