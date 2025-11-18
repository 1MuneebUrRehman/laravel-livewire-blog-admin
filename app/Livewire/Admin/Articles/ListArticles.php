<?php

namespace App\Http\Livewire\Admin\Articles;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ListArticles extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $selectedArticles = [];
    public $selectAll = false;

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

    public function deleteArticle($articleId)
    {
        $article = Article::findOrFail($articleId);

        // Delete featured image if exists
        if ($article->featured_image) {
            Storage::disk('public')->delete($article->featured_image);
        }

        $article->delete();

        session()->flash('message', 'Article deleted successfully.');
    }

    public function bulkDelete()
    {
        Article::whereIn('id', $this->selectedArticles)->delete();
        $this->selectedArticles = [];
        $this->selectAll        = false;

        session()->flash('message', 'Selected articles deleted successfully.');
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedArticles = $this->articles->pluck('id')->toArray();
        } else {
            $this->selectedArticles = [];
        }
    }

    public function getArticlesProperty()
    {
        return Article::with(['category', 'user'])
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('content', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.articles.list-articles', [
            'articles' => $this->articles,
        ]);
    }
}