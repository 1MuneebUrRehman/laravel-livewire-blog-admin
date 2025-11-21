<div class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <!-- Page Header - Matching Single Article -->
    <div class="relative bg-gradient-to-r from-indigo-600 via-purple-600 to-blue-600 text-white overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-black/10">
            <div class="absolute inset-0 bg-gradient-to-r from-black/10 to-transparent"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between">
                <div>
                    <nav class="flex mb-4" aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-2 text-sm text-indigo-200">
                            <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                            <li><i class="fas fa-chevron-right text-xs"></i></li>
                            <li><a href="{{ route('articles') }}" class="hover:text-white transition">Articles</a></li>
                            <li><i class="fas fa-chevron-right text-xs"></i></li>
                            <li class="text-white">{{ $category->name }}</li>
                        </ol>
                    </nav>
                    <h1 class="text-4xl font-bold mb-2">{{ $category->name }}</h1>
                    <p class="text-lg opacity-90 max-w-2xl">{{ $category->description ?? 'Explore articles in this category' }}</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <div class="inline-flex items-center bg-white/10 backdrop-blur-sm px-6 py-3 rounded-full text-sm font-semibold">
                        <i class="fas fa-newspaper mr-2"></i>
                        {{ $category->articles_count }} Published Articles
                    </div>
                </div>
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 -mt-6">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content Area -->
            <div class="lg:col-span-3">
                <!-- Search Bar -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <input
                                        type="text"
                                        wire:model.live="search"
                                        placeholder="Search articles in {{ $category->name }}..."
                                        class="w-full px-4 py-3 pl-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent"
                                >
                                <i class="fas fa-search text-gray-400 absolute left-3 top-3.5"></i>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-600 text-sm hidden sm:block">View:</span>
                            <div class="flex items-center space-x-2">
                                <button
                                        type="button"
                                        wire:click="setViewMode('grid')"
                                        class="px-4 py-2 rounded-lg text-sm font-medium transition {{ $viewMode === 'grid' ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                                >
                                    <i class="fas fa-th-large mr-2"></i>Grid
                                </button>
                                <button
                                        type="button"
                                        wire:click="setViewMode('list')"
                                        class="px-4 py-2 rounded-lg text-sm font-medium transition {{ $viewMode === 'list' ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                                >
                                    <i class="fas fa-list mr-2"></i>List
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Articles Grid -->
                @if($articles->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($articles as $article)
                            <article class="category-card bg-white rounded-xl shadow-sm p-6 block hover:no-underline">
                                <!-- Article Image -->
                                <div class="relative overflow-hidden rounded-lg mb-4">
                                    <img
                                            src="{{ $article->featured_image ?? 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=400&h=250&fit=crop' }}"
                                            alt="{{ $article->title }}"
                                            class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
                                    >
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-white/90 backdrop-blur-sm text-gray-900 px-3 py-1.5 rounded-full text-xs font-semibold">
                                            {{ $article->category->name }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Article Meta -->
                                <div class="flex items-center justify-between mb-3 text-sm text-gray-500">
                                    <span class="flex items-center">
                                        <i class="far fa-calendar mr-1.5"></i>
                                        {{ $article->published_at?->format('M j, Y') ?? 'Draft' }}
                                    </span>
                                    <span class="flex items-center">
                                        <i class="far fa-clock mr-1.5"></i>
                                        {{ $article->reading_time }} min
                                    </span>
                                </div>

                                <!-- Article Title -->
                                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 hover:text-indigo-600 transition-colors">
                                    <a href="{{ route('articles.show', $article->slug) }}" class="hover:no-underline">
                                        {{ $article->title }}
                                    </a>
                                </h3>

                                <!-- Article Excerpt -->
                                <p class="text-gray-600 mb-4 text-sm leading-relaxed line-clamp-3">
                                    {{ Str::limit($article->excerpt, 120) }}
                                </p>

                                <!-- Article Footer -->
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-xs font-semibold text-white">
                                            {{ substr($article->user->name, 0, 1) }}
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">{{ $article->user->name }}</span>
                                    </div>
                                    <div class="flex items-center space-x-3 text-sm text-gray-500">
                                        <span class="flex items-center space-x-1">
                                            <i class="far fa-heart"></i>
                                            <span>{{ $article->likes_count }}</span>
                                        </span>
                                        <span class="flex items-center space-x-1">
                                            <i class="far fa-comment"></i>
                                            <span>{{ $article->comments_count }}</span>
                                        </span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($articles->hasPages())
                        <div class="mt-12">
                            {{ $articles->links('vendor.pagination.tailwind') }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="col-span-3 text-center py-12">
                        <i class="fas fa-newspaper text-4xl text-gray-400 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No articles found</h3>
                        <p class="text-gray-600">Try adjusting your search criteria</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-1 space-y-8">
                <!-- Category Stats -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center mr-3 shadow-sm">
                            <i class="fas fa-chart-bar text-white text-sm"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Category Stats</h3>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Total Articles</span>
                            <span class="font-semibold text-gray-900">{{ $category->articles_count }}</span>
                        </div>
                    </div>
                </div>

                <!-- Related Categories -->
                @if($relatedCategories->count() > 0)
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center mr-3 shadow-sm">
                                <i class="fas fa-folder text-white text-sm"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Related Categories</h3>
                        </div>
                        <div class="space-y-3">
                            @foreach($relatedCategories as $relatedCategory)
                                <a href="{{ route('articles', ['category' => $relatedCategory->slug]) }}"
                                   class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors group">
                                    <div class="w-10 h-10 bg-indigo-50 rounded-lg flex items-center justify-center group-hover:bg-indigo-100 transition-colors">
                                        <i class="fas {{ $relatedCategory->icon ?? 'fa-folder' }} text-indigo-600"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors truncate">
                                            {{ $relatedCategory->name }}
                                        </h4>
                                        <p class="text-sm text-gray-500">{{ $relatedCategory->articles_count }}
                                            articles</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

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
                                   class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm cursor-pointer hover:bg-indigo-600 hover:text-white transition">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
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

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush