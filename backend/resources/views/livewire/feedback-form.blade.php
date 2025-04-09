<div class="p-8 bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
    <h2 class="text-2xl font-bold mb-6 text-green-700 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
        Share Your Feedback
    </h2>

    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg flex items-center border-l-4 border-green-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit="save" class="space-y-6">
        <div>
            <label for="customer_name" class="block text-sm font-medium text-gray-700">Your Name</label>
            <input 
                type="text" 
                id="customer_name" 
                wire:model="customer_name" 
                class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-green-500 focus:outline-none focus:ring-1 focus:ring-green-500"
                placeholder="Enter your name"
            >
            @error('customer_name') 
                <span class="text-red-500 text-sm mt-1 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </span> 
            @enderror
        </div>

        <div>
            <label for="message" class="block text-sm font-medium text-gray-700">Your Message</label>
            <textarea 
                id="message" 
                wire:model="message" 
                rows="4" 
                class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-green-500 focus:outline-none focus:ring-1 focus:ring-green-500"
                placeholder="What would you like to tell us?"
            ></textarea>
            @error('message') 
                <span class="text-red-500 text-sm mt-1 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </span> 
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-3">How happy are you with this app?</label>
            <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg">
                @foreach(range(1, 5) as $ratingOption)
                    <label class="flex flex-col items-center cursor-pointer transition-transform duration-200 hover:scale-110">
                        <input type="radio" wire:model="rating" value="{{ $ratingOption }}" class="sr-only">
                        <span class="text-4xl p-2 {{ $rating == $ratingOption ? 'bg-green-100 ring-2 ring-green-500 ring-offset-2 rounded-full scale-110' : '' }}">
                            @if($ratingOption == 1) 🥲 
                            @elseif($ratingOption == 2) 😐 
                            @elseif($ratingOption == 3) 🙂 
                            @elseif($ratingOption == 4) 😄 
                            @elseif($ratingOption == 5) 🤩 
                            @endif
                        </span>
                        <span class="text-xs mt-1 font-medium {{ $rating == $ratingOption ? 'text-green-600' : 'text-gray-500' }}">{{ $ratingOption }}</span>
                    </label>
                @endforeach
            </div>
            @error('rating') 
                <span class="text-red-500 text-sm mt-1 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </span> 
            @enderror
        </div>

        <div>
            <button 
                type="submit" 
                class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                </svg>
                Submit Feedback
            </button>
        </div>
    </form>
</div>
