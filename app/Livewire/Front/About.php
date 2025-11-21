<?php

namespace App\Livewire\Front;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.front')]
class About extends Component
{
    public function render()
    {
        return view('livewire.front.about');
    }
}