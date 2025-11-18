<?php

namespace App\Http\Livewire\Admin\Articles;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateArticle extends Component
{
    use WithFileUploads;

    public $title;
    public $content;
    public $excerpt;
    public $category_id;
    public $tags = [];
    public $status = 'draft';
    public $featured_image;
    public $meta_title;
    public $meta_description;

    protected $rules = [
        'title'            => 'required|string|max:255',
        'content'          => 'required|string',
        'excerpt'          => 'nullable|string|max:500',
        'category_id'      => 'required|exists:categories,id',
        'tags'             => 'array',
        'tags.*'           => 'exists:tags,id',
        'status'           => 'required|in:draft,published',
        'featured_image'   => 'nullable|image|max:2048',
        'meta_title'       => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:500',
    ];

    public function save()
    {
        $this->validate();

        $article = Article::create([
            'title'            => $this->title,
            'slug'             => Str::slug($this->title),
            'content'          => $this->content,
            'excerpt'          => $this->excerpt,
            'category_id'      => $this->category_id,
            'status'           => $this->status,
            'user_id'          => auth()->id(),
            'meta_title'       => $this->meta_title,
            'meta_description' => $this->meta_description,
        ]);

        if ($this->featured_image) {
            $imagePath = $this->featured_image->store('articles', 'public');
            $article->update(['featured_image' => $imagePath]);
        }

        if (!empty($this->tags)) {
            $article->tags()->sync($this->tags);
        }

        session()->flash('message', 'Article created successfully.');

        return redirect()->route('admin.articles.index');
    }

    public function render()
    {
        return view('livewire.admin.articles.create-article', [
            'categories' => Category::all(),
            'allTags'    => Tag::all(),
        ]);
    }
}