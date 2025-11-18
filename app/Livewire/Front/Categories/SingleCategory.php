<?php

namespace App\Http\Livewire\Front\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class SingleCategory extends Component
{
    use WithPagination;

    public $category;
    public $sort = 'latest';

    protected $queryString = ['sort'];

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    public function updatingSort()
    {
        $this->resetPage();
    }

    public function getArticlesProperty()
    {
        return $this->category->articles()
            ->with(['user', 'tags'])
            ->published()
            ->when($this->sort, function ($query) {
                match ($this->sort) {
                    'oldest' => $query->oldest(),
                    'popular' => $query->orderBy('views', 'desc'),
                    default => $query->latest(),
                };
            })
            ->paginate(9);
    }

    public function render()
    {
        return view('livewire.front.categories.single-category', [
            'articles' => $this->articles,
        ]);
    }
}