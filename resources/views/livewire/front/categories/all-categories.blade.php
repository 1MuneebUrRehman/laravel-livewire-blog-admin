<div class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <!-- Page Header - Matching All Articles -->
    <div class="relative bg-gradient-to-r from-indigo-600 via-purple-600 to-blue-600 text-white overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-black/10">
            <div class="absolute inset-0 bg-gradient-to-r from-black/10 to-transparent"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-5xl font-bold mb-4 bg-gradient-to-r from-white to-indigo-100 bg-clip-text text-transparent">
                    Browse Categories
                </h1>
                <p class="text-xl opacity-95 leading-relaxed">
                    Explore our comprehensive collection of articles organized by topic.
                    Find expert insights on technology, business, marketing, and more.
                </p>
            </div>
        </div>

        <!-- Wave Decoration -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full h-12 text-gray-50" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
                      opacity=".25" fill="currentColor"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z"
                      opacity=".5" fill="currentColor"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"
                      fill="currentColor"></path>
            </svg>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 -mt-2">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content Area -->
            <div class="lg:col-span-3">
                <!-- Search & Filter Card -->
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
                            <span class="text-gray-600 text-sm hidden sm:block">Filter:</span>
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
                                href="{{ route('category.show', $category->slug) }}"
                                class="category-card bg-white rounded-xl shadow-sm p-6 text-center block hover:no-underline group transition-all duration-300 hover:-translate-y-1"
                        >
                            <!-- Icon Container -->
                            <div class="relative mb-4">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-xl {{ $colors['icon'] }} bg-opacity-10 group-hover:scale-110 transition-transform duration-300">
                                    @if($category->icon)
                                        <i class="{{ $category->icon }} text-2xl"></i>
                                    @else
                                        <i class="fas fa-folder text-2xl"></i>
                                    @endif
                                </div>
                            </div>

                            <!-- Content -->
                            <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors duration-200">
                                {{ $category->name }}
                            </h3>
                            <p class="text-gray-600 mb-4 text-sm leading-relaxed line-clamp-2">
                                {{ $category->description ?? 'Explore articles in this category' }}
                            </p>
                            <div>
                                <span class="{{ $colors['badge'] }} px-3 py-1.5 rounded-full text-xs font-semibold inline-flex items-center gap-1">
                                    <i class="fas fa-file-alt text-xs"></i>
                                    {{ $category->articles_count }} {{ Str::plural('Article', $category->articles_count) }}
                                </span>
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
            <aside class="lg:col-span-1 space-y-8">
                <!-- Popular Tags -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center mr-3 shadow-sm">
                            <i class="fas fa-tags text-white text-sm"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Popular Tags</h3>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($popularTags as $tag)
                            <a
                                    href="{{ route('articles', ['tag' => $tag->slug]) }}"
                                    class="bg-gray-100 text-gray-700 px-3 py-1.5 rounded-full text-sm cursor-pointer hover:bg-indigo-600 hover:text-white transition"
                            >
                                #{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Category Stats -->
                <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-chart-bar text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white">Category Stats</h3>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-white/10 rounded-lg">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-folder text-indigo-200"></i>
                                <span class="text-indigo-100">Total Categories</span>
                            </div>
                            <span class="font-bold text-white">{{ $stats['total_categories'] }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-white/10 rounded-lg">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-file-alt text-indigo-200"></i>
                                <span class="text-indigo-100">Total Articles</span>
                            </div>
                            <span class="font-bold text-white">{{ $stats['total_articles'] }}</span>
                        </div>
                        @if($stats['most_popular'])
                            <div class="flex items-center justify-between p-3 bg-white/10 rounded-lg">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-fire text-indigo-200"></i>
                                    <span class="text-indigo-100">Most Popular</span>
                                </div>
                                <span class="font-bold text-white text-sm text-right">{{ $stats['most_popular']->name }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </aside>
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

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush