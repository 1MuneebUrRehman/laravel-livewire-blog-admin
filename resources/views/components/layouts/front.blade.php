<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Welcome') - {{ config('app.name', 'Laravel Blog') }}</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('description', 'A modern blog built with Laravel and Livewire')">
    <meta name="keywords" content="@yield('keywords', 'blog, laravel, livewire, tailwindcss')">
    <meta name="author" content="{{ config('app.name', 'Laravel Blog') }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('title', 'Welcome') - {{ config('app.name', 'Laravel Blog') }}">
    <meta property="og:description" content="@yield('description', 'A modern blog built with Laravel and Livewire')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    @yield('og-image')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet"/>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles

    <!-- Additional Styles -->
    @stack('styles')
</head>
<body class="font-sans antialiased bg-white">
<!-- Header -->
<header class="bg-white shadow-sm sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9m0 0v12m0 0h6m-6 0h6"/>
                    </svg>
                    <span class="text-xl font-bold text-gray-900">{{ config('app.name', 'Laravel Blog') }}</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium transition duration-300 {{ request()->routeIs('home') ? 'text-blue-600' : '' }}">
                    Home
                </a>
                <a href="{{ route('articles.index') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium transition duration-300 {{ request()->routeIs('articles.index') ? 'text-blue-600' : '' }}">
                    Articles
                </a>

                <!-- Categories Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                            class="flex items-center text-gray-700 hover:text-blue-600 font-medium transition duration-300">
                        Categories
                        <svg class="ml-1 w-4 h-4" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open"
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform translate-y-0"
                         x-transition:leave-end="opacity-0 transform -translate-y-2"
                         class="absolute top-full left-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50 border">
                        @php
                            $categories = \App\Models\Category::withCount('articles')->get();
                        @endphp
                        @foreach($categories as $category)
                            <a href="{{ route('categories.show', $category) }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-blue-600 transition duration-300">
                                {{ $category->name }}
                                <span class="text-gray-400 text-xs ml-1">({{ $category->articles_count }})</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('search') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium transition duration-300 {{ request()->routeIs('search') ? 'text-blue-600' : '' }}">
                    Search
                </a>
            </nav>

            <!-- Right side items -->
            <div class="flex items-center space-x-4">
                <!-- Search Button (Mobile) -->
                <a href="{{ route('search') }}" class="md:hidden p-2 text-gray-600 hover:text-blue-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </a>

                <!-- Auth Links -->
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                                class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition duration-300">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <span class="text-white text-sm font-semibold">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </span>
                            </div>
                            <span class="hidden md:block">{{ auth()->user()->name }}</span>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open"
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50 border">
                            @if(auth()->user()->hasRole('admin'))
                                <a href="{{ route('admin.dashboard') }}"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    Admin Dashboard
                                </a>
                            @endif
                            <a href="{{ route('profile.edit') }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}"
                           class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">
                            Sign in
                        </a>
                        <a href="{{ route('register') }}"
                           class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition duration-300">
                            Sign up
                        </a>
                    </div>
                @endauth

                <!-- Mobile menu button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="md:hidden p-2 text-gray-600 hover:text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div x-data="{ mobileMenuOpen: false }" class="md:hidden">
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             class="bg-white border-t py-4 px-4 space-y-4">
            <a href="{{ route('home') }}"
               class="block text-gray-700 hover:text-blue-600 font-medium transition duration-300 {{ request()->routeIs('home') ? 'text-blue-600' : '' }}">
                Home
            </a>
            <a href="{{ route('articles.index') }}"
               class="block text-gray-700 hover:text-blue-600 font-medium transition duration-300 {{ request()->routeIs('articles.index') ? 'text-blue-600' : '' }}">
                Articles
            </a>

            <!-- Mobile Categories -->
            <div x-data="{ categoriesOpen: false }">
                <button @click="categoriesOpen = !categoriesOpen"
                        class="flex items-center justify-between w-full text-gray-700 hover:text-blue-600 font-medium transition duration-300">
                    Categories
                    <svg class="w-4 h-4" :class="{ 'rotate-180': categoriesOpen }" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="categoriesOpen" class="ml-4 mt-2 space-y-2">
                    @php
                        $categories = \App\Models\Category::withCount('articles')->get();
                    @endphp
                    @foreach($categories as $category)
                        <a href="{{ route('categories.show', $category) }}"
                           class="block text-sm text-gray-600 hover:text-blue-600 transition duration-300">
                            {{ $category->name }}
                            <span class="text-gray-400 text-xs ml-1">({{ $category->articles_count }})</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <a href="{{ route('search') }}"
               class="block text-gray-700 hover:text-blue-600 font-medium transition duration-300 {{ request()->routeIs('search') ? 'text-blue-600' : '' }}">
                Search
            </a>

            <!-- Mobile Auth Links -->
            @guest
                <div class="pt-4 border-t space-y-3">
                    <a href="{{ route('login') }}"
                       class="block text-gray-700 hover:text-blue-600 font-medium transition duration-300">
                        Sign in
                    </a>
                    <a href="{{ route('register') }}"
                       class="block bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition duration-300 text-center">
                        Sign up
                    </a>
                </div>
            @endguest
        </div>
    </div>
</header>

<!-- Main Content -->
<main>
    {{ $slot }}
</main>

<!-- Footer -->
<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand -->
            <div class="md:col-span-2">
                <div class="flex items-center space-x-2 mb-4">
                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9m0 0v12m0 0h6m-6 0h6"/>
                    </svg>
                    <span class="text-xl font-bold">{{ config('app.name', 'Laravel Blog') }}</span>
                </div>
                <p class="text-gray-400 mb-4 max-w-md">
                    A modern blog platform built with Laravel and Livewire. Sharing knowledge, ideas, and insights with
                    the world.
                </p>
                <div class="flex space-x-4">
                    <!-- Social Links -->
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition duration-300">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('articles.index') }}"
                           class="text-gray-400 hover:text-white transition duration-300">Articles</a>
                    </li>
                    <li>
                        <a href="{{ route('search') }}" class="text-gray-400 hover:text-white transition duration-300">Search</a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition duration-300">Sign
                            In</a>
                    </li>
                </ul>
            </div>

            <!-- Categories -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Categories</h3>
                <ul class="space-y-2">
                    @php
                        $footerCategories = \App\Models\Category::withCount('articles')
                            ->orderBy('articles_count', 'desc')
                            ->limit(5)
                            ->get();
                    @endphp
                    @foreach($footerCategories as $category)
                        <li>
                            <a href="{{ route('categories.show', $category) }}"
                               class="text-gray-400 hover:text-white transition duration-300">
                                {{ $category->name }}
                                <span class="text-gray-500 text-xs">({{ $category->articles_count }})</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-gray-800 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-400 text-sm">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel Blog') }}. All rights reserved.
            </p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="text-gray-400 hover:text-white text-sm transition duration-300">Privacy Policy</a>
                <a href="#" class="text-gray-400 hover:text-white text-sm transition duration-300">Terms of Service</a>
                <a href="#" class="text-gray-400 hover:text-white text-sm transition duration-300">Contact</a>
            </div>
        </div>
    </div>
</footer>

<!-- Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<!-- Livewire Scripts -->
@livewireScripts

<!-- Additional Scripts -->
@stack('scripts')

<script>
    // Close mobile menu when clicking on a link
    document.addEventListener('DOMContentLoaded', function () {
        const mobileLinks = document.querySelectorAll('.md\\:hidden a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function () {
                const mobileMenu = document.querySelector('[x-data] [x-show]');
                if (mobileMenu) {
                    mobileMenu.__x.$data.mobileMenuOpen = false;
                }
            });
        });
    });

    // Add smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
</body>
</html>