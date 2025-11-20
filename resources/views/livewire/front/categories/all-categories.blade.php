<div class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-full backdrop-blur-sm mb-6">
                    <i class="fas fa-folder-tree text-2xl"></i>
                </div>
                <h1 class="text-5xl font-bold mb-6 bg-gradient-to-r from-white to-indigo-100 bg-clip-text text-transparent">
                    Browse Categories
                </h1>
                <p class="text-xl max-w-3xl mx-auto opacity-90 leading-relaxed">
                    Explore our comprehensive collection of articles organized by topic.
                    Find expert insights on technology, business, marketing, and more.
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 -mt-8 relative z-10">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content Area -->
            <div class="lg:w-3/4">
                <!-- Search & Filter Card -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/60 p-8 mb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                        <div class="flex-1">
                            <div class="relative">
                                <input
                                        type="text"
                                        wire:model.live="search"
                                        placeholder="Search categories..."
                                        class="w-full px-6 py-4 pl-12 rounded-xl border border-gray-200 bg-white/50 focus:outline-none focus:ring-3 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all duration-200 placeholder-gray-400"
                                >
                                <i class="fas fa-search text-gray-400 absolute left-4 top-1/2 transform -translate-y-1/2"></i>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-600 text-sm font-medium hidden sm:block">Filter by:</span>
                            <div class="flex items-center space-x-3 bg-gray-100/50 rounded-xl p-1">
                                <button
                                        type="button"
                                        wire:click="$set('filter', 'all')"
                                        class="px-6 py-2.5 rounded-lg text-sm font-semibold transition-all duration-200 {{ $filter === 'all' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}"
                                >
                                    All Categories
                                </button>
                                <button
                                        type="button"
                                        wire:click="$set('filter', 'popular')"
                                        class="px-6 py-2.5 rounded-lg text-sm font-semibold transition-all duration-200 {{ $filter === 'popular' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}"
                                >
                                    Most Popular
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Categories Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($categories as $index => $category)
                        @php
                            $colors = $this->getCategoryColor($index);
                        @endphp
                        <a
                                href="{{ route('articles', ['category' => $category->slug]) }}"
                                class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl p-8 text-center block hover:no-underline relative overflow-hidden transition-all duration-300 hover:-translate-y-2"
                        >
                            <!-- Background Gradient Effect -->
                            <div class="absolute inset-0 bg-gradient-to-br from-white to-gray-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                            <!-- Icon Container -->
                            <div class="relative mb-6">
                                <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl {{ $colors['icon'] }} bg-opacity-10 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                                    @if($category->icon)
                                        <i class="{{ $category->icon }} text-3xl"></i>
                                    @else
                                        <i class="fas fa-folder text-3xl"></i>
                                    @endif
                                </div>
                            </div>

                            <!-- Content -->
                            <h3 class="text-xl font-bold text-gray-900 mb-3 relative z-10 group-hover:text-indigo-700 transition-colors duration-200">
                                {{ $category->name }}
                            </h3>
                            <p class="text-gray-600 mb-6 leading-relaxed relative z-10">
                                {{ $category->description ?? 'Explore articles in this category' }}
                            </p>
                            <div class="relative z-10">
                                <span class="{{ $colors['badge'] }} px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center gap-2 group-hover:scale-105 transition-transform duration-200">
                                    <i class="fas fa-file-alt text-xs"></i>
                                    {{ $category->articles_count }} {{ Str::plural('Article', $category->articles_count) }}
                                </span>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-3 text-center py-16">
                            <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-3xl mb-6">
                                <i class="fas fa-folder-open text-3xl text-gray-400"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">No categories found</h3>
                            <p class="text-gray-600 text-lg">Try adjusting your search criteria or browse all
                                categories</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/4">
                <!-- Popular Tags -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/60 p-8 mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-tags text-indigo-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Popular Tags</h3>
                    </div>
                    <div class="tag-cloud flex flex-wrap gap-3">
                        @foreach($popularTags as $tag)
                            <a
                                    href="{{ route('articles', ['tag' => $tag->slug]) }}"
                                    class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm font-medium cursor-pointer hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 hover:text-white hover:border-transparent hover:shadow-lg transition-all duration-200 hover:-translate-y-1"
                            >
                                #{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Category Stats -->
                <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl shadow-xl p-8 text-white">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white">Category Stats</h3>
                    </div>
                    <div class="space-y-5">
                        <div class="flex items-center justify-between p-4 bg-white/10 rounded-xl backdrop-blur-sm">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-folder text-indigo-200"></i>
                                <span class="text-indigo-100">Total Categories</span>
                            </div>
                            <span class="font-bold text-white text-lg">{{ $stats['total_categories'] }}</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-white/10 rounded-xl backdrop-blur-sm">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-file-alt text-indigo-200"></i>
                                <span class="text-indigo-100">Total Articles</span>
                            </div>
                            <span class="font-bold text-white text-lg">{{ $stats['total_articles'] }}</span>
                        </div>
                        @if($stats['most_popular'])
                            <div class="flex items-center justify-between p-4 bg-white/10 rounded-xl backdrop-blur-sm">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-fire text-indigo-200"></i>
                                    <span class="text-indigo-100">Most Popular</span>
                                </div>
                                <span class="font-bold text-white text-lg text-right">{{ $stats['most_popular']->name }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .category-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 20px;
            overflow: hidden;
        }

        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .category-icon {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .category-card:hover .category-icon {
            transform: scale(1.15) rotate(5deg);
        }

        .tag-cloud a {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(8px);
        }

        .tag-cloud a:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.4);
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #c7d2fe;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a5b4fc;
        }
    </style>
@endpush