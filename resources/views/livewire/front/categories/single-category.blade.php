<div class="bg-gray-50 min-h-screen">
    <!-- Breadcrumb -->
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-500 hover:text-indigo-600 transition text-sm">Home</a>
                    </li>
                    <li>
                        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                    </li>
                    <li>
                        <a href="{{ route('categories') }}"
                           class="text-gray-500 hover:text-indigo-600 transition text-sm">Categories</a>
                    </li>
                    <li>
                        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                    </li>
                    <li aria-current="page">
                        <span class="text-indigo-600 font-medium text-sm">{{ $category->name }}</span>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Category Header -->
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="mb-6 md:mb-0">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="text-indigo-600 category-icon">
                            <i class="fas {{ $category->icon ?? 'fa-folder' }} text-5xl"></i>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $category->name }}</h1>
                            <p class="text-gray-600 text-lg">{{ $category->articles_count }} published articles
                                about {{ $category->description ?? 'various topics' }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-indigo-50 text-indigo-700 px-4 py-2 rounded-lg">
                        <span class="font-semibold">{{ $category->articles_count }}</span> Published Articles
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content Area -->
            <div class="lg:w-3/4">
                <!-- View Controls -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">{{ $category->name }} Articles</h2>
                            <p class="text-gray-600 text-sm mt-1">Latest published insights
                                on {{ strtolower($category->name) }} trends and innovations</p>
                        </div>

                        <!-- View Toggle -->
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-600 text-sm hidden sm:block">View:</span>
                            <div class="flex items-center space-x-2">
                                <button wire:click="setViewMode('grid')"
                                        class="view-toggle-btn p-2 rounded-md {{ $viewMode === 'grid' ? 'bg-indigo-100 text-indigo-700 active' : 'text-gray-500 hover:bg-gray-100' }}">
                                    <i class="fas fa-th"></i>
                                </button>
                                <button wire:click="setViewMode('list')"
                                        class="view-toggle-btn p-2 rounded-md {{ $viewMode === 'list' ? 'bg-indigo-100 text-indigo-700 active' : 'text-gray-500 hover:bg-gray-100' }}">
                                    <i class="fas fa-list"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Articles Grid/List -->
                @if($category->articles_count > 0)
                    <div id="articles-container"
                         class="{{ $viewMode === 'grid' ? 'grid grid-cols-1 md:grid-cols-2 gap-6' : 'space-y-6' }}">
                        @foreach($articles as $article)
                            <article
                                    class="article-card bg-white overflow-hidden rounded-xl shadow-sm hover:shadow-lg transition-shadow">
                                @if($viewMode === 'grid')
                                    <div class="relative">
                                        <img src="{{ $article->featured_image ?? 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400&h=250&fit=crop' }}"
                                             alt="{{ $article->title }}"
                                             class="w-full h-48 object-cover">
                                        <span class="absolute top-4 left-4 bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            {{ $article->category->name }}
                                        </span>
                                    </div>
                                    <div class="p-6">
                                        <div class="flex items-center space-x-4 mb-3">
                                            <span class="text-gray-500 text-sm">{{ $article->published_at->format('F j, Y') }}</span>
                                            <span class="text-gray-500 text-sm flex items-center">
                                                <i class="fas fa-clock mr-1"></i> {{ $article->reading_time }} min read
                                            </span>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-indigo-600 transition cursor-pointer">
                                            <a href="{{ route('article.show', $article->slug) }}">
                                                {{ $article->title }}
                                            </a>
                                        </h3>
                                        <p class="text-gray-600 mb-4 text-sm">
                                            {{ Str::limit($article->excerpt, 120) }}
                                        </p>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-2">
                                                <img src="{{ $article->user->avatar }}" alt="Author"
                                                     class="w-6 h-6 rounded-full">
                                                <span class="text-sm text-gray-600">{{ $article->user->name }}</span>
                                            </div>
                                            <div class="flex space-x-4 text-sm">
                                                <button class="flex items-center space-x-1 text-gray-600 hover:text-red-500 transition">
                                                    <i class="far fa-heart"></i>
                                                    <span>{{ $article->likes_count }}</span>
                                                </button>
                                                <button class="flex items-center space-x-1 text-gray-600 hover:text-blue-500 transition">
                                                    <i class="far fa-comment"></i>
                                                    <span>{{ $article->comments_count }}</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <!-- List View -->
                                    <div class="flex flex-col md:flex-row">
                                        <div class="md:w-1/4">
                                            <img src="{{ $article->featured_image ?? 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=300&h=200&fit=crop' }}"
                                                 alt="{{ $article->title }}"
                                                 class="w-full h-40 md:h-full object-cover">
                                        </div>
                                        <div class="md:w-3/4 p-6">
                                            <div class="flex items-center space-x-4 mb-3">
                                                <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-semibold">
                                                    {{ $article->category->name }}
                                                </span>
                                                <span class="text-gray-500 text-sm">{{ $article->published_at->format('F j, Y') }}</span>
                                                <span class="text-gray-500 text-sm flex items-center">
                                                    <i class="fas fa-clock mr-1"></i> {{ $article->reading_time }} min read
                                                </span>
                                            </div>
                                            <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-indigo-600 transition cursor-pointer">
                                                <a href="{{ route('article.show', $article->slug) }}">
                                                    {{ $article->title }}
                                                </a>
                                            </h3>
                                            <p class="text-gray-600 mb-4">
                                                {{ Str::limit($article->excerpt, 200) }}
                                            </p>
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-2">
                                                    <img src="{{ $article->user->avatar }}" alt="Author"
                                                         class="w-6 h-6 rounded-full">
                                                    <span class="text-sm text-gray-600">{{ $article->user->name }}</span>
                                                </div>
                                                <div class="flex space-x-4 text-sm">
                                                    <button class="flex items-center space-x-1 text-gray-600 hover:text-red-500 transition">
                                                        <i class="far fa-heart"></i>
                                                        <span>{{ $article->likes_count }}</span>
                                                    </button>
                                                    <button class="flex items-center space-x-1 text-gray-600 hover:text-blue-500 transition">
                                                        <i class="far fa-comment"></i>
                                                        <span>{{ $article->comments_count }}</span>
                                                    </button>
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
                            {{ $articles->links() }}
                        </div>
                    @endif
                @else
                    <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                        <i class="fas fa-inbox text-4xl text-gray-400 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No published articles found</h3>
                        <p class="text-gray-600">There are no published articles in this category yet.</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/4">
                <!-- Related Categories -->
                @if($relatedCategories->count() > 0)
                    <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Related Categories</h3>
                        <div class="space-y-4">
                            @foreach($relatedCategories as $relatedCategory)
                                <a href="{{ route('category.show', $relatedCategory->slug) }}"
                                   class="category-card flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition">
                                    <div class="text-indigo-600 category-icon">
                                        <i class="fas {{ $relatedCategory->icon ?? 'fa-folder' }} text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">{{ $relatedCategory->name }}</h4>
                                        <p class="text-sm text-gray-500">{{ $relatedCategory->articles_count }}
                                            published articles</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Recent Posts -->
                @if($recentArticles->count() > 0)
                    <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Recent {{ $category->name }} Posts</h3>
                        <div class="space-y-4">
                            @foreach($recentArticles as $recentArticle)
                                <a href="{{ route('article.show', $recentArticle->slug) }}"
                                   class="flex items-start space-x-3 group">
                                    <img src="{{ $recentArticle->featured_image_thumb ?? $recentArticle->featured_image ?? 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=60&h=60&fit=crop' }}"
                                         alt="{{ $recentArticle->title }}"
                                         class="w-16 h-16 object-cover rounded-md flex-shrink-0">
                                    <div>
                                        <h4 class="font-semibold text-gray-900 group-hover:text-indigo-600 transition text-sm">
                                            {{ Str::limit($recentArticle->title, 50) }}
                                        </h4>
                                        <p class="text-xs text-gray-500 mt-1">{{ $recentArticle->published_at->format('M j, Y') }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Popular Tags -->
                @if($popularTags->count() > 0)
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">{{ $category->name }} Tags</h3>
                        <div class="tag-cloud flex flex-wrap gap-2">
                            @foreach($popularTags as $tag)
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm cursor-pointer hover:bg-indigo-600 hover:text-white transition">
                                    {{ $tag->name }} ({{ $tag->articles_count }})
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>