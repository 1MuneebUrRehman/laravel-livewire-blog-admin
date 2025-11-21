<?php

namespace App\Livewire\Front;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.front')]
class Contact extends Component
{
    public $name;
    public $email;
    public $message;

    public function submit()
    {
        $this->validate([
            'name'    => 'required|min:3',
            'email'   => 'required|email',
            'message' => 'required|min:10',
        ]);

        // In a real app, we would send an email or save to DB here.
        // For now, just flash a success message.
        session()->flash('message', 'Thank you for contacting us! We will get back to you soon.');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.front.contact');
    }
}