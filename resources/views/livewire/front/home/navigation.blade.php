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
                <a href="{{ route('articles') }}"
                   class="nav-link text-gray-700 hover:text-indigo-600 transition font-medium">Articles</a>
                <a href="{{ route('categories') }}"
                   class="nav-link text-gray-700 hover:text-indigo-600 transition font-medium">Categories</a>
                <a href="{{ route('about') }}"
                   class="nav-link text-gray-700 hover:text-indigo-600 transition font-medium">About</a>
                <a href="{{ route('contact') }}"
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
                    <button id="mobile-menu-button" class="md:hidden p-2">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu - Now included directly in the same file -->
    <div id="mobile-menu" class="mobile-menu md:hidden fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg">
        <div class="flex items-center justify-between p-4 border-b">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-lightbulb text-white"></i>
                </div>
                <h1 class="text-xl font-bold text-gray-900">Insights Hub</h1>
            </div>
            <button id="close-mobile-menu" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="p-4">
            <div class="space-y-4">
                <a href="{{ url('/') }}" class="block py-2 text-gray-700 hover:text-indigo-600 transition font-medium">Home</a>
                <a href="{{ route('articles') }}"
                   class="block py-2 text-gray-700 hover:text-indigo-600 transition font-medium">Articles</a>
                <a href="{{ route('categories') }}"
                   class="block py-2 text-gray-700 hover:text-indigo-600 transition font-medium">Categories</a>
                <a href="{{ route('about') }}"
                   class="block py-2 text-gray-700 hover:text-indigo-600 transition font-medium">About</a>
                <a href="{{ route('contact') }}"
                   class="block py-2 text-gray-700 hover:text-indigo-600 transition font-medium">Contact</a>
                @auth
                    <a href="{{ route('home') }}"
                       class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-indigo-700 transition mt-4 inline-block text-center">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('home') }}"
                       class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-indigo-700 transition mt-4 inline-block text-center">
                        Sign In
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
    // Mobile menu functionality
    document.addEventListener('DOMContentLoaded', function () {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const closeMobileMenu = document.getElementById('close-mobile-menu');

        if (mobileMenuButton && mobileMenu && closeMobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.add('active');
            });

            closeMobileMenu.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', (e) => {
                if (!mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                    mobileMenu.classList.remove('active');
                }
            });
        }
    });
</script>