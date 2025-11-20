<div class="bg-gray-50 min-h-screen">
    <!-- Page Header - Matching All Categories -->
    <div class="page-header-gradient text-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white/10 rounded-2xl backdrop-blur-sm mb-6">
                    <i class="fas {{ $category->icon ?? 'fa-folder' }} text-3xl text-white"></i>
                </div>
                <h1 class="text-4xl font-bold mb-4">{{ $category->name }}</h1>
                <p class="text-xl max-w-3xl mx-auto text-indigo-100">
                    {{ $category->description ?? 'Explore our collection of articles organized by topic. Find insights on technology, business, marketing, and more.' }}
                </p>
                <div class="inline-flex items-center bg-white/10 backdrop-blur-sm px-6 py-3 rounded-full text-sm font-semibold mt-4">
                    <i class="fas fa-newspaper mr-2"></i>
                    {{ $category->articles_count }} Published Articles
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content Area -->
            <div class="lg:w-3/4">
                <!-- Search Bar - Matching All Categories -->
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

                <!-- Articles Grid - Matching Categories Grid -->
                @if($articles->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($articles as $index => $article)
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
                                        {{ $article->formattedPublishedDate }}
                                    </span>
                                    <span class="flex items-center">
                                        <i class="far fa-clock mr-1.5"></i>
                                        {{ $article->reading_time }} min
                                    </span>
                                </div>

                                <!-- Article Title -->
                                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-indigo-600 transition-colors">
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

            <!-- Sidebar - Matching All Categories Sidebar -->
            <div class="lg:w-1/4">
                <!-- Category Stats -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Category Stats</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Total Articles</span>
                            <span class="font-semibold text-gray-900">{{ $category->articles_count }}</span>
                        </div>
                    </div>
                </div>

                <!-- Related Categories -->
                @if($relatedCategories->count() > 0)
                    <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Related Categories</h3>
                        <div class="space-y-3">
                            @foreach($relatedCategories as $relatedCategory)
                                <a href="{{ route('category.show', $relatedCategory->slug) }}"
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
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Popular Tags</h3>
                        <div class="tag-cloud flex flex-wrap gap-2">
                            @foreach($popularTags as $tag)
                                <a href="{{ route('articles', ['tag' => $tag->slug]) }}"
                                   class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm cursor-pointer hover:bg-indigo-600 hover:text-white transition">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
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

        .tag-cloud a {
            transition: all 0.3s ease;
        }

        .tag-cloud a:hover {
            transform: translateY(-2px);
            background-color: #4F46E5;
            color: white;
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