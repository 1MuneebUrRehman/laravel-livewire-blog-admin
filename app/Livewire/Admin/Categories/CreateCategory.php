<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateCategory extends Component
{
    public $name;
    public $description;
    public $meta_title;
    public $meta_description;

    protected $rules = [
        'name'             => 'required|string|max:255|unique:categories,name',
        'description'      => 'nullable|string|max:500',
        'meta_title'       => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:500',
    ];

    public function save()
    {
        $this->validate();

        Category::create([
            'name'             => $this->name,
            'slug'             => Str::slug($this->name),
            'description'      => $this->description,
            'meta_title'       => $this->meta_title,
            'meta_description' => $this->meta_description,
        ]);

        session()->flash('message', 'Category created successfully.');

        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.admin.categories.create-category');
    }
}