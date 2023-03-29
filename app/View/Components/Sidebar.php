<?php

namespace App\View\Components;

use Closure;
use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // $categories = Category::join('category_post', 'category_post.category_id', '=', 'categories.id')
        //     ->select('categories.title', 'categories.slug', DB::raw('count(*) as total'))
        //     ->groupBy('categories.id')
        //     ->limit(5)->get();

        $categories = Category::orderBy('id', 'asc')->get();

        return view('components.sidebar', [
            "categories" => $categories,
        ]);
    }
}
