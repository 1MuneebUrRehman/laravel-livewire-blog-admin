<?php

namespace App\Livewire\Front\Home;

use Livewire\Component;

class MobileMenu extends Component
{
    public $isOpen = false;

    public function open()
    {
        $this->isOpen = true;
    }

    public function close()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.front.home.mobile-menu');
    }
}