<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles

    <!-- Additional Styles -->
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-100">
<div class="min-h-screen">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-800 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0"
         :class="{ '-translate-x-full': !sidebarOpen }"
         x-data="{ sidebarOpen: false }">
        <!-- Logo -->
        <div class="flex items-center justify-between h-16 px-4 bg-gray-900">
            <div class="flex items-center">
                <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9m0 0v12m0 0h6m-6 0h6"/>
                </svg>
                <span class="ml-2 text-xl font-semibold text-white">{{ config('app.name', 'Laravel') }}</span>
            </div>

            <!-- Close button for mobile -->
            <button @click="sidebarOpen = false"
                    class="lg:hidden p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="mt-8 px-4 space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 text-white' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            <!-- Articles -->
            <div x-data="{ open: {{ request()->routeIs('admin.articles.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="flex items-center justify-between w-full px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition duration-300 {{ request()->routeIs('admin.articles.*') ? 'bg-gray-700 text-white' : '' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9m0 0v12m0 0h6m-6 0h6"/>
                        </svg>
                        Articles
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open" x-collapse class="ml-4 mt-2 space-y-1">
                    <a href="{{ route('admin.articles.index') }}"
                       class="flex items-center px-4 py-2 text-sm text-gray-400 rounded-lg hover:bg-gray-700 hover:text-white transition duration-300 {{ request()->routeIs('admin.articles.index') ? 'bg-gray-700 text-white' : '' }}">
                        All Articles
                    </a>
                    <a href="{{ route('admin.articles.create') }}"
                       class="flex items-center px-4 py-2 text-sm text-gray-400 rounded-lg hover:bg-gray-700 hover:text-white transition duration-300 {{ request()->routeIs('admin.articles.create') ? 'bg-gray-700 text-white' : '' }}">
                        Create Article
                    </a>
                </div>
            </div>

            <!-- Categories -->
            <div x-data="{ open: {{ request()->routeIs('admin.categories.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="flex items-center justify-between w-full px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition duration-300 {{ request()->routeIs('admin.categories.*') ? 'bg-gray-700 text-white' : '' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"/>
                        </svg>
                        Categories
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open" x-collapse class="ml-4 mt-2 space-y-1">
                    <a href="{{ route('admin.categories.index') }}"
                       class="flex items-center px-4 py-2 text-sm text-gray-400 rounded-lg hover:bg-gray-700 hover:text-white transition duration-300 {{ request()->routeIs('admin.categories.index') ? 'bg-gray-700 text-white' : '' }}">
                        All Categories
                    </a>
                    <a href="{{ route('admin.categories.create') }}"
                       class="flex items-center px-4 py-2 text-sm text-gray-400 rounded-lg hover:bg-gray-700 hover:text-white transition duration-300 {{ request()->routeIs('admin.categories.create') ? 'bg-gray-700 text-white' : '' }}">
                        Create Category
                    </a>
                </div>
            </div>

            <!-- Tags -->
            <div x-data="{ open: {{ request()->routeIs('admin.tags.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="flex items-center justify-between w-full px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition duration-300 {{ request()->routeIs('admin.tags.*') ? 'bg-gray-700 text-white' : '' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        Tags
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open" x-collapse class="ml-4 mt-2 space-y-1">
                    <a href="{{ route('admin.tags.index') }}"
                       class="flex items-center px-4 py-2 text-sm text-gray-400 rounded-lg hover:bg-gray-700 hover:text-white transition duration-300 {{ request()->routeIs('admin.tags.index') ? 'bg-gray-700 text-white' : '' }}">
                        All Tags
                    </a>
                    <a href="{{ route('admin.tags.create') }}"
                       class="flex items-center px-4 py-2 text-sm text-gray-400 rounded-lg hover:bg-gray-700 hover:text-white transition duration-300 {{ request()->routeIs('admin.tags.create') ? 'bg-gray-700 text-white' : '' }}">
                        Create Tag
                    </a>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-700 my-4"></div>

            <!-- Back to Site -->
            <a href="{{ route('home') }}"
               class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition duration-300">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Back to Site
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="lg:ml-64">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b">
            <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                <!-- Mobile menu button -->
                <button @click="sidebarOpen = true"
                        class="lg:hidden p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <div class="flex-1 flex justify-between items-center">
                    <div class="flex-1 max-w-2xl mx-auto">
                        <!-- You can add a search bar here if needed -->
                    </div>

                    <!-- User menu -->
                    <div class="ml-4 flex items-center md:ml-6" x-data="{ open: false }">
                        <button @click="open = !open"
                                class="max-w-xs flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center">
                                    <span class="text-white font-semibold text-sm">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </span>
                            </div>
                            <span class="ml-2 text-gray-700 hidden md:block">{{ auth()->user()->name }}</span>
                            <svg class="ml-1 w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div x-show="open"
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="origin-top-right absolute right-4 top-16 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                            <a href="{{ route('home') }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                View Site
                            </a>
                            <a href="{{ route('profile.edit') }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Your Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Page Heading -->
                    @if(isset($header))
                        <div class="mb-6">
                            {{ $header }}
                        </div>
                    @endif

                    <!-- Main Content -->
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<!-- Livewire Scripts -->
@livewireScripts

<!-- Additional Scripts -->
@stack('scripts')

<script>
    // Mobile sidebar toggle
    document.addEventListener('alpine:init', () => {
        Alpine.data('sidebar', () => ({
            open: window.innerWidth >= 1024,

            init() {
                // Close sidebar on mobile when clicking outside
                this.$watch('open', (value) => {
                    if (value && window.innerWidth < 1024) {
                        document.body.classList.add('overflow-hidden');
                    } else {
                        document.body.classList.remove('overflow-hidden');
                    }
                });
            },

            closeOnEscape(e) {
                if (e.key === 'Escape') {
                    this.open = false;
                }
            }
        }));
    });

    // Close mobile sidebar when clicking on a link
    document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('nav a');
        links.forEach(link => {
            link.addEventListener('click', function () {
                if (window.innerWidth < 1024) {
                    const sidebar = document.querySelector('[x-data]');
                    if (sidebar) {
                        sidebar.__x.$data.sidebarOpen = false;
                    }
                }
            });
        });
    });
</script>
</body>
</html>