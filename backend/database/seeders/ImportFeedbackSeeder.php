<?php

namespace Database\Seeders;

use App\Models\Feedback;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ImportFeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * This seeder imports feedback data from a JSON file
     */
    public function run(): void
    {
        $jsonPath = base_path('../SEED_DATA.json');
        
        if (File::exists($jsonPath)) {
            $feedbackData = json_decode(File::get($jsonPath), true);
            
            // Import each feedback entry
            foreach ($feedbackData as $feedback) {
                Feedback::create([
                    'customer_name' => $feedback['customer_name'],
                    'message' => $feedback['message'],
                    'rating' => $feedback['rating'],
                    'created_at' => $feedback['created_at'],
                    'updated_at' => $feedback['created_at'],
                ]);
            }
            
            $this->command->info('Imported ' . count($feedbackData) . ' feedback entries');
        } else {
            $this->command->error('Seed data file not found at: ' . $jsonPath);
            
            // Generate additional random feedback if file not found
            $this->generateRandomFeedback();
        }
    }
    
    /**
     * Generate random feedback entries if the JSON file is not available
     */
    private function generateRandomFeedback(): void
    {
        $this->command->info('Generating 30 random feedback entries instead');
        
        $names = [
            'John Smith', 'Jane Doe', 'Robert Brown', 'Lisa Johnson', 'Michael Davis',
            'Emily Wilson', 'David Miller', 'Sarah Moore', 'James Taylor', 'Jessica Anderson'
        ];
        
        $messages = [
            'Great service! Would recommend.',
            'Enjoyed my experience at LilYPad POS.',
            'The staff was very helpful.',
            'Love the app interface, very user friendly.',
            'Had some issues but they were quickly resolved.',
            'Excellent customer service.',
            'The facility was very clean.',
            'My kids had a fantastic time!',
            'Will definitely come back again.',
            'The food options were great.'
        ];
        
        // Create 30 random feedback entries
        for ($i = 0; $i < 30; $i++) {
            $name = $names[array_rand($names)];
            $message = $messages[array_rand($messages)];
            $rating = rand(1, 5);
            $date = now()->subDays(rand(0, 60));
            
            Feedback::create([
                'customer_name' => $name,
                'message' => $message,
                'rating' => $rating,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }
}