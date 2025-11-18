<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class ListCategories extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';

    protected $queryString = ['search', 'sortField', 'sortDirection'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function deleteCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);

        // Check if category has articles
        if ($category->articles()->count() > 0) {
            session()->flash('error', 'Cannot delete category with associated articles.');
            return;
        }

        $category->delete();

        session()->flash('message', 'Category deleted successfully.');
    }

    public function getCategoriesProperty()
    {
        return Category::withCount('articles')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.categories.list-categories', [
            'categories' => $this->categories,
        ]);
    }
}