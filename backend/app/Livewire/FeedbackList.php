<?php

namespace App\Livewire;

use App\Models\Feedback;
use Livewire\Component;
use Livewire\Attributes\On;

class FeedbackList extends Component
{
    public $selectedRating = null;
    
    #[On('feedback-created')]
    public function refreshFeedback()
    {
        // This method will be called when a new feedback is created
    }
    
    public function filterByRating($rating = null)
    {
        $this->selectedRating = $rating;
    }
    
    public function render()
    {
        $query = Feedback::latest();
        
        if ($this->selectedRating) {
            $query->where('rating', $this->selectedRating);
        }
        
        $feedbacks = $query->take(10)->get();
        
        return view('livewire.feedback-list', [
            'feedbacks' => $feedbacks
        ]);
    }
}
