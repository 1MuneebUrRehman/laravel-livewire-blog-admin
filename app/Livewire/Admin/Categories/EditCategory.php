<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class EditCategory extends Component
{
    public $category;
    public $name;
    public $description;
    public $meta_title;
    public $meta_description;

    protected $rules = [
        'name'             => 'required|string|max:255|unique:categories,name,',
        'description'      => 'nullable|string|max:500',
        'meta_title'       => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:500',
    ];

    public function mount(Category $category)
    {
        $this->category         = $category;
        $this->name             = $category->name;
        $this->description      = $category->description;
        $this->meta_title       = $category->meta_title;
        $this->meta_description = $category->meta_description;

        // Update unique rule
        $this->rules['name'] .= $category->id;
    }

    public function update()
    {
        $this->validate();

        $this->category->update([
            'name'             => $this->name,
            'slug'             => Str::slug($this->name),
            'description'      => $this->description,
            'meta_title'       => $this->meta_title,
            'meta_description' => $this->meta_description,
        ]);

        session()->flash('message', 'Category updated successfully.');

        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.admin.categories.edit-category');
    }
}