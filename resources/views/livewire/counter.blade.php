<div class="bg-white rounded-2xl shadow-xl p-8 max-w-md w-full">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-2">Livewire Counter</h1>
    <p class="text-center text-gray-600 mb-8">A simple counter component styled with Tailwind CSS</p>

    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl p-8 mb-8 shadow-lg">
        <h1 class="text-6xl font-bold text-center text-white">{{ $count }}</h1>
    </div>

    <div class="flex justify-center space-x-4">
        <button
                wire:click="decrement"
                class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-opacity-50 flex items-center"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
            </svg>
            Decrement
        </button>

        <button
                wire:click="increment"
                class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-opacity-50 flex items-center"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Increment
        </button>
    </div>

    <div class="mt-8 text-center text-gray-500 text-sm">
        <p>Click the buttons to change the counter value</p>
    </div>
</div>