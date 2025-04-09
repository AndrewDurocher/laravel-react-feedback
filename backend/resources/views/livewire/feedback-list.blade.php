<div class="p-8 bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 mt-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h2 class="text-2xl font-bold text-green-700 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Recent Feedback
        </h2>
        <div class="flex flex-wrap gap-2">
            <button 
                wire:click="filterByRating(null)" 
                class="px-4 py-2 text-sm rounded-lg transition-colors duration-200 flex items-center justify-center {{ is_null($selectedRating) ? 'bg-green-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
                All Ratings
            </button>
            @foreach(range(1, 5) as $rating)
                <button 
                    wire:click="filterByRating({{ $rating }})" 
                    class="px-3 py-2 text-sm rounded-lg transition-all duration-200 {{ $selectedRating == $rating ? 'bg-green-600 text-white shadow-md scale-105' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                >
                    <span class="text-lg">
                        @if($rating == 1) 🥲 
                        @elseif($rating == 2) 😐 
                        @elseif($rating == 3) 🙂 
                        @elseif($rating == 4) 😄 
                        @elseif($rating == 5) 🤩 
                        @endif
                    </span>
                </button>
            @endforeach
        </div>
    </div>

    <div wire:loading class="flex justify-center items-center py-8">
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span class="text-gray-600">Loading feedback...</span>
    </div>

    <div wire:loading.remove>
        @if($feedbacks->isEmpty())
            <div class="text-center py-12 bg-gray-50 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <p class="text-gray-500 text-lg">No feedback found.</p>
                <p class="text-gray-400 mt-1">Be the first to leave feedback!</p>
                
                <div class="mt-6">
                    <a href="/demo/seed" class="inline-flex items-center px-4 py-2 bg-green-100 border border-green-200 rounded-md font-semibold text-xs text-green-700 uppercase tracking-widest hover:bg-green-200 active:bg-green-300 focus:outline-none focus:border-green-500 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Load Sample Data
                    </a>
                </div>
            </div>
        @else
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($feedbacks as $feedback)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $feedback->customer_name }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-700 max-w-xs break-words">{{ $feedback->message }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xl">
                                        @if($feedback->rating == 1) 
                                            <span class="text-red-500" title="Not satisfied">🥲</span> 
                                        @elseif($feedback->rating == 2) 
                                            <span class="text-orange-500" title="Somewhat satisfied">😐</span> 
                                        @elseif($feedback->rating == 3) 
                                            <span class="text-yellow-500" title="Satisfied">🙂</span> 
                                        @elseif($feedback->rating == 4) 
                                            <span class="text-green-500" title="Very satisfied">😄</span> 
                                        @elseif($feedback->rating == 5) 
                                            <span class="text-green-600" title="Extremely satisfied">🤩</span> 
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $feedback->created_at->format('M d, Y g:i A') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 text-right text-sm text-gray-500">
                Showing {{ $feedbacks->count() }} of the most recent feedback entries.
            </div>
        @endif
    </div>
</div>
