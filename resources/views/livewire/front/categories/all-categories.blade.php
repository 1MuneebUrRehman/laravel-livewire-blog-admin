<div class="bg-gray-50 min-h-screen">
    <!-- Page Header -->
    <div class="page-header-gradient text-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">Browse Categories</h1>
                <p class="text-xl max-w-3xl mx-auto">
                    Explore our collection of articles organized by topic. Find insights on technology, business,
                    marketing, and more.
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content Area -->
            <div class="lg:w-3/4">
                <!-- Search Bar -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <input
                                        type="text"
                                        wire:model.live="search"
                                        placeholder="Search categories..."
                                        class="w-full px-4 py-3 pl-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent"
                                >
                                <i class="fas fa-search text-gray-400 absolute left-3 top-3.5"></i>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-600 text-sm hidden sm:block">Showing:</span>
                            <div class="flex items-center space-x-2">
                                <button
                                        type="button"
                                        wire:click="$set('filter', 'all')"
                                        class="px-4 py-2 rounded-lg text-sm font-medium transition {{ $filter === 'all' ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                                >
                                    All Categories
                                </button>
                                <button
                                        type="button"
                                        wire:click="$set('filter', 'popular')"
                                        class="px-4 py-2 rounded-lg text-sm font-medium transition {{ $filter === 'popular' ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                                >
                                    Most Popular
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Categories Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($categories as $index => $category)
                        @php
                            $colors = $this->getCategoryColor($index);
                        @endphp
                        <a
                                href="{{ route('articles', ['category' => $category->slug]) }}"
                                class="category-card bg-white rounded-xl shadow-sm p-6 text-center block hover:no-underline"
                        >
                            <div class="{{ $colors['icon'] }} mb-4 category-icon">
                                @if($category->icon)
                                    <i class="{{ $category->icon }} text-4xl"></i>
                                @else
                                    <i class="fas fa-folder text-4xl"></i>
                                @endif
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $category->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ $category->description ?? 'Explore articles in this category' }}</p>
                            <div class="{{ $colors['badge'] }} px-3 py-1 rounded-full text-sm font-medium inline-block">
                                {{ $category->articles_count }} {{ Str::plural('Article', $category->articles_count) }}
                            </div>
                        </a>
                    @empty
                        <div class="col-span-3 text-center py-12">
                            <i class="fas fa-folder-open text-4xl text-gray-400 mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">No categories found</h3>
                            <p class="text-gray-600">Try adjusting your search criteria</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/4">
                <!-- Popular Tags -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Popular Tags</h3>
                    <div class="tag-cloud flex flex-wrap gap-2">
                        @foreach($popularTags as $tag)
                            <a
                                    href="{{ route('articles', ['tag' => $tag->slug]) }}"
                                    class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm cursor-pointer hover:bg-indigo-600 hover:text-white transition"
                            >
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Category Stats -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Category Stats</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Total Categories</span>
                            <span class="font-semibold text-gray-900">{{ $stats['total_categories'] }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Total Articles</span>
                            <span class="font-semibold text-gray-900">{{ $stats['total_articles'] }}</span>
                        </div>
                        @if($stats['most_popular'])
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Most Popular</span>
                                <span class="font-semibold text-gray-900">{{ $stats['most_popular']->name }}</span>
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
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .category-icon {
            transition: all 0.3s ease;
        }

        .category-card:hover .category-icon {
            transform: scale(1.1);
        }

        .tag-cloud a {
            transition: all 0.3s ease;
        }

        .tag-cloud a:hover {
            transform: translateY(-2px);
            background-color: #4F46E5;
            color: white;
        }
    </style>
@endpush