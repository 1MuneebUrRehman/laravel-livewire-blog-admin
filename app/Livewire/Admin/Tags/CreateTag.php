<?php

namespace App\Http\Livewire\Admin\Tags;

use App\Models\Tag;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateTag extends Component
{
    public $name;
    public $description;

    protected $rules = [
        'name'        => 'required|string|max:255|unique:tags,name',
        'description' => 'nullable|string|max:500',
    ];

    public function save()
    {
        $this->validate();

        Tag::create([
            'name'        => $this->name,
            'slug'        => Str::slug($this->name),
            'description' => $this->description,
        ]);

        session()->flash('message', 'Tag created successfully.');

        return redirect()->route('admin.tags.index');
    }

    public function render()
    {
        return view('livewire.admin.tags.create-tag');
    }
}