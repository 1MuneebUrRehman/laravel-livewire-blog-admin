<div>
    <!-- Mobile Menu Overlay -->
    @if($isOpen)
        <div class="fixed inset-0 z-40 bg-black bg-opacity-50 md:hidden" wire:click="close"></div>
    @endif

    <!-- Mobile Menu Panel -->
    <div class="mobile-menu md:hidden fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform transition-transform duration-300 ease-in-out {{ $isOpen ? 'translate-x-0' : '-translate-x-full' }}">
        <div class="flex items-center justify-between p-4 border-b">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-lightbulb text-white"></i>
                </div>
                <h1 class="text-xl font-bold text-gray-900">Insights Hub</h1>
            </div>
            <button wire:click="close" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="p-4">
            <div class="space-y-4">
                <a href="{{ url('/') }}" class="block py-2 text-gray-700 hover:text-indigo-600 transition font-medium"
                   wire:click="close">Home</a>
                <a href="{{ route('home') }}"
                   class="block py-2 text-gray-700 hover:text-indigo-600 transition font-medium" wire:click="close">Articles</a>
                <a href="{{ route('home') }}"
                   class="block py-2 text-gray-700 hover:text-indigo-600 transition font-medium" wire:click="close">Categories</a>
                <a href="{{ route('home') }}"
                   class="block py-2 text-gray-700 hover:text-indigo-600 transition font-medium" wire:click="close">About</a>
                <a href="{{ route('home') }}"
                   class="block py-2 text-gray-700 hover:text-indigo-600 transition font-medium" wire:click="close">Contact</a>
                @auth
                    <a href="{{ route('home') }}"
                       class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-indigo-700 transition mt-4 block text-center"
                       wire:click="close">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('home') }}"
                       class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-indigo-700 transition mt-4 block text-center"
                       wire:click="close">
                        Sign In
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:init', () => {
            // Open mobile menu when button is clicked
            document.getElementById('mobile-menu-button')?.addEventListener('click', () => {
                @this.
                open();
            });
        });
    </script>
</div>