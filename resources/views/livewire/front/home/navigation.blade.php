<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-lightbulb text-white"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900">Insights Hub</h1>
                </a>
            </div>
            <div class="hidden md:flex space-x-8">
                <a href="{{ url('/') }}" class="nav-link text-gray-700 hover:text-indigo-600 transition font-medium">Home</a>
                <a href="{{ route('home') }}"
                   class="nav-link text-gray-700 hover:text-indigo-600 transition font-medium">Articles</a>
                <a href="{{ route('home') }}"
                   class="nav-link text-gray-700 hover:text-indigo-600 transition font-medium">Categories</a>
                <a href="{{ route('home') }}"
                   class="nav-link text-gray-700 hover:text-indigo-600 transition font-medium">About</a>
                <a href="{{ route('home') }}"
                   class="nav-link text-gray-700 hover:text-indigo-600 transition font-medium">Contact</a>
            </div>
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ route('home') }}"
                       class="hidden md:block bg-indigo-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-indigo-700 transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('home') }}"
                       class="hidden md:block bg-indigo-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-indigo-700 transition">
                        Sign In
                    </a>
                @endauth
                <button id="mobile-menu-button" class="md:hidden">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <livewire:front.home.mobile-menu/>
</nav>