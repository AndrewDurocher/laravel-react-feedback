<?php

use Illuminate\Support\Facades\Route;
use App\Models\Feedback;
use Illuminate\Support\Facades\Artisan;

// Demo route to seed sample data (only for demonstration purposes)
Route::get('/demo/seed', function () {
    // Check if we already have feedback data
    if (Feedback::count() < 5) {
        Artisan::call('db:seed');
        return response()->json(['message' => 'Sample feedback data has been loaded!']);
    }
    
    return response()->json(['message' => 'Database already contains feedback data.']);
});
