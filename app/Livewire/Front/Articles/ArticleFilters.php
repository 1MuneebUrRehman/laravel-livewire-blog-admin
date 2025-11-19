<?php

namespace App\Livewire\Front\Articles;

use Livewire\Component;

class ArticleFilters extends Component
{
    public $search = '';
    public $category = '';
    public $sort = 'newest';
    public $view = 'grid';
    public $categories = [];

    protected $queryString = [
        'search'   => ['except' => ''],
        'category' => ['except' => ''],
        'sort'     => ['except' => 'newest'],
        'view'     => ['except' => 'grid']
    ];

    protected $listeners = ['category-selected' => 'setCategory'];

    public function setCategory($data)
    {
        $this->category = $data['category'];
        $this->updated('category');
    }

    public function updated($property)
    {
        if (in_array($property, ['search', 'category', 'sort', 'view'])) {
            $this->dispatch('filters-updated', [
                'search'   => $this->search,
                'category' => $this->category,
                'sort'     => $this->sort,
                'view'     => $this->view
            ]);
        }
    }

    public function render()
    {
        return view('livewire.front.articles.article-filters');
    }
}