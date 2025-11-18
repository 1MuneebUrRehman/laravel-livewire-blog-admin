<?php

namespace App\Http\Livewire\Admin\Tags;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class ListTags extends Component
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

    public function deleteTag($tagId)
    {
        $tag = Tag::findOrFail($tagId);
        $tag->delete();

        session()->flash('message', 'Tag deleted successfully.');
    }

    public function getTagsProperty()
    {
        return Tag::withCount('articles')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.tags.list-tags', [
            'tags' => $this->tags,
        ]);
    }
}