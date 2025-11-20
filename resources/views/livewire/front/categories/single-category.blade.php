<div class="min-h-screen bg-gray-50">
    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-3">
                    <li>
                        <a href="{{ route('home') }}"
                           class="text-gray-500 hover:text-indigo-600 transition-colors text-sm font-medium">
                            Home
                        </a>
                    </li>
                    <li>
                        <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </li>
                    <li>
                        <a href="{{ route('categories') }}"
                           class="text-gray-500 hover:text-indigo-600 transition-colors text-sm font-medium">
                            Categories
                        </a>
                    </li>
                    <li>
                        <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </li>
                    <li aria-current="page">
                        <span class="text-indigo-600 font-semibold text-sm">{{ $category->name }}</span>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Category Header -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white/10 rounded-2xl backdrop-blur-sm mb-6">
                    <i class="fas {{ $category->icon ?? 'fa-folder' }} text-3xl text-white"></i>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $category->name }}</h1>
                <p class="text-xl text-indigo-100 mb-6 leading-relaxed">
                    {{ $category->description ?? 'Explore the latest insights and trends' }}
                </p>
                <div class="inline-flex items-center bg-white/10 backdrop-blur-sm px-6 py-3 rounded-full text-sm font-semibold">
                    <i class="fas fa-newspaper mr-2"></i>
                    {{ $category->articles_count }} Published Articles
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 -mt-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content Area -->
            <div class="lg:w-3/4">
                <!-- View Controls -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">Latest Articles</h2>
                            <p class="text-gray-600">Discover the most recent publications
                                in {{ strtolower($category->name) }}</p>
                        </div>

                        <!-- View Toggle -->
                        <div class="flex items-center space-x-3">
                            <span class="text-gray-600 text-sm font-medium hidden sm:block">View:</span>
                            <div class="flex items-center bg-gray-100 rounded-lg p-1">
                                <button wire:click="setViewMode('grid')"
                                        class="p-2 rounded-md transition-all duration-200 {{ $viewMode === 'grid' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
                                    <i class="fas fa-th-large text-sm"></i>
                                </button>
                                <button wire:click="setViewMode('list')"
                                        class="p-2 rounded-md transition-all duration-200 {{ $viewMode === 'list' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
                                    <i class="fas fa-list text-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Articles Grid/List -->
                @if($category->articles_count > 0)
                    <div id="articles-container"
                         class="{{ $viewMode === 'grid' ? 'grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6' : 'space-y-6' }}">
                        @foreach($articles as $article)
                            <article
                                    class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 group">
                                @if($viewMode === 'grid')
                                    <!-- Grid View -->
                                    <div class="relative overflow-hidden">
                                        <img src="{{ $article->featured_image ?? 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=400&h=250&fit=crop' }}"
                                             alt="{{ $article->title }}"
                                             class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                        <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-gray-900 px-3 py-1.5 rounded-full text-xs font-semibold">
                                            {{ $article->category->name }}
                                        </span>
                                    </div>
                                    <div class="p-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <span class="text-sm text-gray-500 flex items-center">
                                                <i class="far fa-calendar mr-1.5"></i>
                                                {{ $article->formattedPublishedDate }}
                                            </span>
                                            <span class="text-sm text-gray-500 flex items-center">
                                                <i class="far fa-clock mr-1.5"></i>
                                                {{ $article->reading_time }} min
                                            </span>
                                        </div>
                                        <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-indigo-600 transition-colors">
                                            <a href="{{ route('articles.show', $article->slug) }}"
                                               class="hover:no-underline">
                                                {{ $article->title }}
                                            </a>
                                        </h3>
                                        <p class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed">
                                            {{ Str::limit($article->excerpt, 120) }}
                                        </p>
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
                                    </div>
                                @else
                                    <!-- List View -->
                                    <div class="flex flex-col md:flex-row">
                                        <div class="md:w-1/3 relative">
                                            <img src="{{ $article->featured_image ?? 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=300&h=200&fit=crop' }}"
                                                 alt="{{ $article->title }}"
                                                 class="w-full h-48 md:h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                            <div class="absolute inset-0 bg-gradient-to-r from-black/10 to-transparent md:hidden"></div>
                                        </div>
                                        <div class="md:w-2/3 p-6">
                                            <div class="flex items-center space-x-4 mb-3">
                                                <span class="bg-indigo-50 text-indigo-700 px-3 py-1 rounded-full text-xs font-semibold">
                                                    {{ $article->category->name }}
                                                </span>
                                                <span class="text-sm text-gray-500">{{ $article->formattedPublishedDate }}</span>
                                                <span class="text-sm text-gray-500 flex items-center">
                                                    <i class="far fa-clock mr-1"></i>
                                                    {{ $article->reading_time }} min read
                                                </span>
                                            </div>
                                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-indigo-600 transition-colors">
                                                <a href="{{ route('articles.show', $article->slug) }}"
                                                   class="hover:no-underline">
                                                    {{ $article->title }}
                                                </a>
                                            </h3>
                                            <p class="text-gray-600 mb-4 leading-relaxed">
                                                {{ Str::limit($article->excerpt, 200) }}
                                            </p>
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-3">
                                                    <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-xs font-semibold text-white">
                                                        {{ substr($article->user->name, 0, 1) }}
                                                    </div>
                                                    <span class="text-sm font-medium text-gray-700">{{ $article->user->name }}</span>
                                                </div>
                                                <div class="flex items-center space-x-4 text-sm text-gray-500">
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
                                        </div>
                                    </div>
                                @endif
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
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-16 text-center">
                        <div class="max-w-md mx-auto">
                            <div class="w-20 h-20 bg-indigo-50 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-inbox text-3xl text-indigo-600"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">No Articles Yet</h3>
                            <p class="text-gray-600 mb-6">We're working on creating amazing content for this category.
                                Check back soon!</p>
                            <a href="{{ route('home') }}"
                               class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Browse All Articles
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/4 space-y-8">
                <!-- Related Categories -->
                @if($relatedCategories->count() > 0)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-tags text-indigo-600 mr-2"></i>
                            Related Categories
                        </h3>
                        <div class="space-y-3">
                            @foreach($relatedCategories as $relatedCategory)
                                <a href="{{ route('category.show', $relatedCategory->slug) }}"
                                   class="flex items-center space-x-4 p-3 rounded-xl hover:bg-gray-50 transition-colors group">
                                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-xl flex items-center justify-center group-hover:from-indigo-200 group-hover:to-purple-200 transition-colors">
                                        <i class="fas {{ $relatedCategory->icon ?? 'fa-folder' }} text-indigo-600 text-lg"></i>
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

                <!-- Recent Posts -->
                @if($recentArticles->count() > 0)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-fire text-orange-500 mr-2"></i>
                            Recent in {{ $category->name }}
                        </h3>
                        <div class="space-y-4">
                            @foreach($recentArticles as $recentArticle)
                                <a href="{{ route('articles.show', $recentArticle->slug) }}"
                                   class="flex items-start space-x-3 group">
                                    <img src="{{ $recentArticle->featured_image_thumb ?? $recentArticle->featured_image ?? 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=60&h=60&fit=crop' }}"
                                         alt="{{ $recentArticle->title }}"
                                         class="w-14 h-14 object-cover rounded-xl flex-shrink-0 group-hover:scale-105 transition-transform duration-200">
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors text-sm leading-tight line-clamp-2">
                                            {{ $recentArticle->title }}
                                        </h4>
                                        <p class="text-xs text-gray-500 mt-1.5 flex items-center">
                                            <i class="far fa-clock mr-1"></i>
                                            {{ $recentArticle->formattedPublishedDate }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Popular Tags -->
                @if($popularTags->count() > 0)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-hashtag text-purple-600 mr-2"></i>
                            Popular Tags
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($popularTags as $tag)
                                <a href="{{ route('home') }}"
                                   class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-700 rounded-full text-sm font-medium hover:bg-indigo-600 hover:text-white transition-colors duration-200">
                                    {{ $tag->name }}
                                    <span class="ml-1.5 text-xs bg-white/20 px-1.5 py-0.5 rounded-full">
                                        {{ $tag->articles_count }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>