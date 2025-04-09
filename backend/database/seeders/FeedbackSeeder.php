<?php

namespace Database\Seeders;

use App\Models\Feedback;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample feedback topics and comments
        $topics = [
            'Customer Service' => [
                'The staff was very friendly and helpful',
                'I had an excellent experience with your team',
                'Your customer service team resolved my issue quickly',
                'The employee who helped me was very knowledgeable',
                'I was impressed by how attentive your staff was',
            ],
            'App Experience' => [
                'The app is very intuitive and easy to use',
                'I love the new features you\'ve added',
                'The app interface is clean and modern',
                'I found everything I needed quickly',
                'The app loads very fast on my device',
            ],
            'Family Entertainment' => [
                'My kids had a great time at your facility',
                'We enjoyed the variety of activities available',
                'The entertainment options for all ages were excellent',
                'Our family had an amazing day at LilYPad',
                'The birthday party package exceeded our expectations',
            ],
            'Food & Beverages' => [
                'The food quality was excellent',
                'Great variety of snacks and drinks',
                'The menu had good options for kids and adults',
                'The prices were reasonable for the quality',
                'Service at the food counter was quick',
            ],
            'Cleanliness' => [
                'The venue was very clean and well-maintained',
                'The bathrooms were spotless',
                'I was impressed by how clean everything was',
                'The staff did a great job keeping everything tidy',
                'The hygienic standards were excellent',
            ],
        ];

        // Sample customer names
        $firstNames = ['James', 'Mary', 'John', 'Patricia', 'Robert', 'Jennifer', 'Michael', 'Linda', 'William', 'Elizabeth', 
                      'David', 'Susan', 'Richard', 'Jessica', 'Joseph', 'Sarah', 'Thomas', 'Karen', 'Charles', 'Nancy',
                      'Lisa', 'Daniel', 'Matthew', 'Betty', 'Anthony', 'Margaret', 'Mark', 'Sandra', 'Donald', 'Ashley'];
        
        $lastNames = ['Smith', 'Johnson', 'Williams', 'Jones', 'Brown', 'Davis', 'Miller', 'Wilson', 'Moore', 'Taylor',
                      'Anderson', 'Thomas', 'Jackson', 'White', 'Harris', 'Martin', 'Thompson', 'Garcia', 'Martinez', 'Robinson',
                      'Clark', 'Rodriguez', 'Lewis', 'Lee', 'Walker', 'Hall', 'Allen', 'Young', 'Hernandez', 'King'];

        // Create 100 feedback entries
        for ($i = 0; $i < 100; $i++) {
            // Random customer name
            $firstName = $firstNames[array_rand($firstNames)];
            $lastName = $lastNames[array_rand($lastNames)];
            $customerName = $firstName . ' ' . $lastName;
            
            // Random topic and feedback
            $topic = array_rand($topics);
            $messages = $topics[$topic];
            $message = $messages[array_rand($messages)];
            
            // Add some variance with additional sentences occasionally
            if (rand(0, 2) > 0) {
                $additionalComments = [
                    'I would definitely recommend this to friends and family.',
                    'Looking forward to coming back soon!',
                    'This exceeded my expectations.',
                    'I appreciate your attention to detail.',
                    'Keep up the great work!',
                    'This is why we keep coming back.',
                    'My children absolutely loved it.',
                    'The value for money is excellent.',
                    'Thank you for making our visit special.',
                    'This has become our favorite family activity.',
                ];
                $message .= ' ' . $additionalComments[array_rand($additionalComments)];
            }
            
            // Sometimes add topic as prefix
            if (rand(0, 3) === 0) {
                $message = "[$topic] " . $message;
            }
            
            // Random rating with weighted distribution
            // More likely to be 4-5, less likely to be 1-2
            $ratingDistribution = [1, 2, 3, 3, 4, 4, 4, 5, 5, 5];
            $rating = $ratingDistribution[array_rand($ratingDistribution)];
            
            // Random date within the last year, more recent dates are more likely
            $daysAgo = rand(0, 365);
            $weight = rand(1, 10);
            if ($weight > 7) { // 30% chance for older feedback
                $daysAgo = rand(30, 365);
            } else { // 70% chance for more recent feedback
                $daysAgo = rand(0, 60);
            }
            $date = now()->subDays($daysAgo);
            
            Feedback::create([
                'customer_name' => $customerName,
                'message' => $message,
                'rating' => $rating,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }
}
