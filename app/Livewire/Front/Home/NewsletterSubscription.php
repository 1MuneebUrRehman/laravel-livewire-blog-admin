<?php

namespace App\Livewire\Front\Home;

use Livewire\Component;

class NewsletterSubscription extends Component
{
    public $email = '';

    protected $rules = [
        'email' => 'required|email'
    ];

    public function subscribe()
    {
        $this->validate();

        // Implement newsletter subscription logic
        // You might want to store this in a newsletter_subscribers table

        session()->flash('message', 'Thank you for subscribing to our newsletter!');
        $this->email = '';
    }

    public function render()
    {
        return view('livewire.front.home.newsletter-subscription');
    }
}