<?php

namespace Tests\Feature;

use App\Models\Feedback;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeedbackTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_feedback()
    {
        // Create some feedback entries
        Feedback::factory()->count(15)->create();

        // Get the 10 most recent feedback entries
        $response = $this->getJson('/api/feedback');

        $response->assertStatus(200)
            ->assertJsonCount(10);
    }

    public function test_can_filter_feedback_by_rating()
    {
        // Create feedback entries with different ratings
        Feedback::factory()->count(3)->create(['rating' => 5]);
        Feedback::factory()->count(2)->create(['rating' => 4]);
        Feedback::factory()->count(4)->create(['rating' => 3]);

        // Get feedback with rating 5
        $response = $this->getJson('/api/feedback?rating=5');

        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonPath('0.rating', 5);
    }

    public function test_can_create_new_feedback()
    {
        $feedbackData = [
            'customer_name' => 'John Doe',
            'message' => 'This app is great!',
            'rating' => 5
        ];

        $response = $this->postJson('/api/feedback', $feedbackData);

        $response->assertStatus(201)
            ->assertJsonPath('feedback.customer_name', 'John Doe')
            ->assertJsonPath('feedback.message', 'This app is great!')
            ->assertJsonPath('feedback.rating', 5);

        // Verify it was saved to the database
        $this->assertDatabaseHas('feedback', $feedbackData);
    }

    public function test_validates_required_fields()
    {
        $response = $this->postJson('/api/feedback', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['customer_name', 'message', 'rating']);
    }

    public function test_validates_rating_range()
    {
        $feedbackData = [
            'customer_name' => 'John Doe',
            'message' => 'This app is great!',
            'rating' => 10 // Invalid rating
        ];

        $response = $this->postJson('/api/feedback', $feedbackData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['rating']);
    }
}