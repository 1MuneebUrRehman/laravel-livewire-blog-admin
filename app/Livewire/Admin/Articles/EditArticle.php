<?php

namespace App\Http\Livewire\Admin\Articles;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditArticle extends Component
{
    use WithFileUploads;

    public $article;
    public $title;
    public $content;
    public $excerpt;
    public $category_id;
    public $tags = [];
    public $status = 'draft';
    public $featured_image;
    public $new_featured_image;
    public $meta_title;
    public $meta_description;

    protected $rules = [
        'title'              => 'required|string|max:255',
        'content'            => 'required|string',
        'excerpt'            => 'nullable|string|max:500',
        'category_id'        => 'required|exists:categories,id',
        'tags'               => 'array',
        'tags.*'             => 'exists:tags,id',
        'status'             => 'required|in:draft,published',
        'new_featured_image' => 'nullable|image|max:2048',
        'meta_title'         => 'nullable|string|max:255',
        'meta_description'   => 'nullable|string|max:500',
    ];

    public function mount(Article $article)
    {
        $this->article          = $article;
        $this->title            = $article->title;
        $this->content          = $article->content;
        $this->excerpt          = $article->excerpt;
        $this->category_id      = $article->category_id;
        $this->tags             = $article->tags->pluck('id')->toArray();
        $this->status           = $article->status;
        $this->featured_image   = $article->featured_image;
        $this->meta_title       = $article->meta_title;
        $this->meta_description = $article->meta_description;
    }

    public function update()
    {
        $this->validate();

        $this->article->update([
            'title'            => $this->title,
            'slug'             => Str::slug($this->title),
            'content'          => $this->content,
            'excerpt'          => $this->excerpt,
            'category_id'      => $this->category_id,
            'status'           => $this->status,
            'meta_title'       => $this->meta_title,
            'meta_description' => $this->meta_description,
        ]);

        if ($this->new_featured_image) {
            // Delete old image
            if ($this->featured_image) {
                Storage::disk('public')->delete($this->featured_image);
            }

            $imagePath = $this->new_featured_image->store('articles', 'public');
            $this->article->update(['featured_image' => $imagePath]);
        }

        $this->article->tags()->sync($this->tags);

        session()->flash('message', 'Article updated successfully.');

        return redirect()->route('admin.articles.index');
    }

    public function render()
    {
        return view('livewire.admin.articles.edit-article', [
            'categories' => Category::all(),
            'allTags'    => Tag::all(),
        ]);
    }
}