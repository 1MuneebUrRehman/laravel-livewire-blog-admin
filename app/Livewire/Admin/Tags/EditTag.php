<?php

namespace App\Http\Livewire\Admin\Tags;

use App\Models\Tag;
use Illuminate\Support\Str;
use Livewire\Component;

class EditTag extends Component
{
    public $tag;
    public $name;
    public $description;

    protected $rules = [
        'name'        => 'required|string|max:255|unique:tags,name,',
        'description' => 'nullable|string|max:500',
    ];

    public function mount(Tag $tag)
    {
        $this->tag         = $tag;
        $this->name        = $tag->name;
        $this->description = $tag->description;

        // Update unique rule
        $this->rules['name'] .= $tag->id;
    }

    public function update()
    {
        $this->validate();

        $this->tag->update([
            'name'        => $this->name,
            'slug'        => Str::slug($this->name),
            'description' => $this->description,
        ]);

        session()->flash('message', 'Tag updated successfully.');

        return redirect()->route('admin.tags.index');
    }

    public function render()
    {
        return view('livewire.admin.tags.edit-tag');
    }
}