<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeedbackRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Feedback::latest();
        
        if ($request->has('rating')) {
            $query->where('rating', $request->rating);
        }
        
        $feedbacks = $query->paginate(5); // 5 items per page
        
        // Debug log the response
        Log::info('Feedback API response', [
            'count' => $feedbacks->count(),
            'total' => $feedbacks->total(),
            'current_page' => $feedbacks->currentPage(),
            'last_page' => $feedbacks->lastPage(),
        ]);
        
        return response()->json($feedbacks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeedbackRequest $request)
    {
        $feedback = Feedback::create($request->validated());
        
        return response()->json([
            'message' => 'Feedback submitted successfully',
            'feedback' => $feedback
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
