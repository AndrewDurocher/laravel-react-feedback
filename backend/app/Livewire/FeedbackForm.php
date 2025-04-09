<?php

namespace App\Livewire;

use App\Models\Feedback;
use Livewire\Component;
use Livewire\Attributes\Rule;

class FeedbackForm extends Component
{
    #[Rule('required|string|max:255')]
    public $customer_name = '';
    
    #[Rule('required|string')]
    public $message = '';
    
    #[Rule('required|integer|min:1|max:5')]
    public $rating = 3;
    
    public function save()
    {
        $validated = $this->validate();
        
        Feedback::create($validated);
        
        $this->reset(['customer_name', 'message']);
        $this->rating = 3;
        
        $this->dispatch('feedback-created');
        
        session()->flash('message', 'Feedback submitted successfully!');
    }
    
    public function render()
    {
        return view('livewire.feedback-form');
    }
}
