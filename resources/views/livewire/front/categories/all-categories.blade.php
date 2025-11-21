<div class="bg-gray-50 min-h-screen">
    <!-- Page Header - Fixed to match Single Article -->
    <div class="page-header-gradient text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between">
                <div>
                    <nav class="flex mb-4" aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-2 text-sm text-indigo-200">
                            <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                            <li><i class="fas fa-chevron-right text-xs"></i></li>
                            <li><a href="{{ route('articles') }}" class="hover:text-white transition">Articles</a></li>
                            <li><i class="fas fa-chevron-right text-xs"></i></li>
                            <li class="text-white">Categories</li>
                        </ol>
                    </nav>
                    <h1 class="text-4xl font-bold mb-2">Browse Categories</h1>
                    <p class="text-lg opacity-90 max-w-2xl">
                        Explore our comprehensive collection of articles organized by topic.
                        Find expert insights on technology, business, marketing, and more.
                    </p>
                </div>
                <div class="mt-4 md:mt-0">
                    <div class="inline-flex items-center bg-white/20 px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm">
                        <i class="fas fa-folder mr-2"></i>
                        {{ $stats['total_categories'] ?? 0 }} {{ Str::plural('Category', $stats['total_categories'] ?? 0) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content Area -->
            <div class="lg:col-span-3">
                <!-- Search and Filter Bar -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <input
                                        type="text"
                                        wire:model.live="search"
                                        placeholder="Search categories..."
                                        class="w-full px-4 py-3 pl-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors duration-200"
                                >
                                <i class="fas fa-search text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-600 text-sm font-medium hidden sm:block">Filter:</span>
                            <div class="flex bg-gray-100 rounded-lg p-1">
                                <button
                                        type="button"
                                        wire:click="$set('filter', 'all')"
                                        class="px-4 py-2 rounded-md text-sm font-medium transition-all duration-200 {{ $filter === 'all' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}"
                                >
                                    All Categories
                                </button>
                                <button
                                        type="button"
                                        wire:click="$set('filter', 'popular')"
                                        class="px-4 py-2 rounded-md text-sm font-medium transition-all duration-200 {{ $filter === 'popular' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}"
                                >
                                    Most Popular
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Categories Grid -->
                @if($categories->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                        @foreach($categories as $index => $category)
                            @php
                                $colors = $this->getCategoryColor($index);
                            @endphp
                            <a
                                    href="{{ route('category.show', $category->slug) }}"
                                    class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-all duration-300 group block hover:no-underline"
                            >
                                <div class="p-6">
                                    <!-- Category Header -->
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-12 h-12 {{ $colors['icon'] }} bg-opacity-10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                                @if($category->icon)
                                                    <i class="{{ $category->icon }} text-xl {{ $colors['text'] }}"></i>
                                                @else
                                                    <i class="fas fa-folder text-xl {{ $colors['text'] }}"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors duration-200">
                                                    {{ $category->name }}
                                                </h3>
                                                <div class="flex items-center mt-1">
                                                    <span class="{{ $colors['badge'] }} px-2 py-1 rounded-full text-xs font-semibold inline-flex items-center">
                                                        <i class="fas fa-file-alt text-xs mr-1"></i>
                                                        {{ $category->articles_count }} {{ Str::plural('Article', $category->articles_count) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Category Description -->
                                    <p class="text-gray-600 mb-4 text-sm leading-relaxed line-clamp-2">
                                        {{ $category->description ?? 'Explore articles in this category' }}
                                    </p>

                                    <!-- Category Footer -->
                                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                        <div class="text-xs text-gray-500">
                                            @if($category->created_at)
                                                <i class="far fa-calendar mr-1"></i>
                                                Created {{ $category->created_at->format('M Y') }}
                                            @endif
                                        </div>
                                        <div class="text-indigo-600 text-sm font-medium group-hover:translate-x-1 transition-transform duration-200">
                                            Browse <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($categories->hasPages())
                        <div class="mt-12">
                            {{ $categories->links('vendor.pagination.tailwind') }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16 bg-white rounded-xl shadow-sm">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                            <i class="fas fa-folder-open text-3xl text-gray-400"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">No categories found</h3>
                        <p class="text-gray-600 text-lg mb-6">Try adjusting your search criteria</p>
                        <a href="{{ route('articles') }}"
                           class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to All Articles
                        </a>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-1">
                <div class="sticky-sidebar space-y-8">
                    <!-- Category Stats -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center mr-3 shadow-sm">
                                <i class="fas fa-chart-bar text-white text-sm"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Category Stats</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-600">Total Categories</span>
                                <span class="font-semibold text-gray-900">{{ $stats['total_categories'] ?? 0 }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-600">Total Articles</span>
                                <span class="font-semibold text-gray-900">{{ $stats['total_articles'] ?? 0 }}</span>
                            </div>
                            @if(isset($stats['most_popular']) && $stats['most_popular'])
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-600">Most Popular</span>
                                    <span class="text-sm text-gray-500 truncate max-w-[120px]"
                                          title="{{ $stats['most_popular']->name }}">
                                        {{ $stats['most_popular']->name }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Popular Tags -->
                    @if($popularTags->count() > 0)
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center mr-3 shadow-sm">
                                    <i class="fas fa-tags text-white text-sm"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Popular Tags</h3>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                @foreach($popularTags as $tag)
                                    <a href="{{ route('articles', ['tag' => $tag->slug]) }}"
                                       class="bg-gray-100 text-gray-700 px-3 py-1.5 rounded-full text-sm hover:bg-indigo-600 hover:text-white transition-all duration-200 hover:-translate-y-0.5">
                                        #{{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </aside>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .page-header-gradient {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #2563eb 100%);
        }

        .sticky-sidebar {
            position: sticky;
            top: 2rem;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Smooth transitions */
        .transition-all {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
@endpush