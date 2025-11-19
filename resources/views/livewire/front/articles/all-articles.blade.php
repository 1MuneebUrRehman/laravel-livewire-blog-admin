<div class="bg-gray-50 min-h-screen">
    <!-- Page Header -->
    <div class="page-header-gradient text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between">
                <div>
                    <h1 class="text-4xl font-bold mb-2">All Articles</h1>
                    <p class="text-lg opacity-90 max-w-2xl">Browse our complete collection of business insights and
                        expert perspectives</p>
                </div>
                <div class="mt-6 md:mt-0">
                    <div class="flex items-center space-x-2 text-sm">
                        <span class="opacity-80">Showing {{ $articles->count() }} of {{ $articles->total() }} articles</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 -mt-6">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content Area -->
            <div class="lg:col-span-3">
                <!-- Search and Filter Bar -->
                <div class="bg-white sidebar-card p-6 mb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <!-- Search Input -->
                        <div class="flex-1">
                            <div class="relative">
                                <input
                                        type="text"
                                        wire:model.live="search"
                                        placeholder="Search articles..."
                                        class="w-full px-4 py-3 pl-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent"
                                >
                                <i class="fas fa-search text-gray-400 absolute left-3 top-3.5"></i>
                            </div>
                        </div>

                        <!-- View Toggle -->
                        <div class="flex items-center space-x-2">
                            <span class="text-gray-600 text-sm hidden sm:block">View:</span>
                            <button
                                    wire:click="toggleView('grid')"
                                    class="p-2 rounded-md {{ $view === 'grid' ? 'bg-indigo-100 text-indigo-700' : 'text-gray-500 hover:bg-gray-100' }}"
                            >
                                <i class="fas fa-th"></i>
                            </button>
                            <button
                                    wire:click="toggleView('list')"
                                    class="p-2 rounded-md {{ $view === 'list' ? 'bg-indigo-100 text-indigo-700' : 'text-gray-500 hover:bg-gray-100' }}"
                            >
                                <i class="fas fa-list"></i>
                            </button>
                        </div>

                        <!-- Sort Dropdown -->
                        <div class="relative">
                            <select
                                    wire:model.live="sort"
                                    class="appearance-none w-full md:w-auto px-4 py-3 pr-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent bg-white"
                            >
                                <option value="newest">Newest First</option>
                                <option value="oldest">Oldest First</option>
                                <option value="popular">Most Popular</option>
                                <option value="title">Title A-Z</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Options -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex flex-wrap gap-2">
                            <button
                                    wire:click="$set('category', '')"
                                    class="px-4 py-2 rounded-full text-sm font-medium transition {{ !$category ? 'active-filter' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                            >
                                All Articles
                            </button>
                            @foreach($categories as $cat)
                                <button
                                        wire:click="$set('category', '{{ $cat->slug }}')"
                                        class="px-4 py-2 rounded-full text-sm font-medium transition {{ $category === $cat->slug ? 'active-filter' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                                >
                                    {{ $cat->name }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Articles Grid/List -->
                <div class="{{ $view === 'grid' ? 'grid grid-cols-1 md:grid-cols-2 gap-6' : 'space-y-6' }}">
                    @forelse($articles as $article)
                        <article class="article-card bg-white overflow-hidden">
                            <div class="{{ $view === 'list' ? 'flex flex-col md:flex-row' : '' }}">
                                @if($view === 'list')
                                    <div class="md:w-1/3">
                                        @endif
                                        <div class="relative">
                                            <img
                                                    src="{{ $article->featured_image ?: 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=400&h=250&fit=crop' }}"
                                                    alt="{{ $article->title }}"
                                                    class="{{ $view === 'list' ? 'w-full h-48 md:h-full object-cover' : 'w-full h-48 object-cover' }}"
                                            >
                                            <span class="absolute top-4 left-4 bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        {{ $article->category->name }}
                                    </span>
                                        </div>
                                        @if($view === 'list')
                                    </div>
                                    <div class="md:w-2/3 p-6">
                                        @else
                                            <div class="p-6">
                                                @endif
                                                <div class="flex flex-wrap items-center gap-4 mb-3">
                                        <span class="text-gray-500 text-sm">
                                            {{ $article->published_at?->format('F j, Y') }}
                                        </span>
                                                    <span class="text-gray-500 text-sm flex items-center">
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ $article->reading_time }} min read
                                        </span>
                                                </div>
                                                <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-indigo-600 transition cursor-pointer article-title">
                                                    <a href="{{ route('home') }}">
                                                        {{ $article->title }}
                                                    </a>
                                                </h3>
                                                <p class="text-gray-600 mb-4 text-sm">
                                                    {{ $article->excerpt }}
                                                </p>
                                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                                    <div class="flex items-center space-x-2">
                                                        <img
                                                                src="{{ $article->user->profile_photo_url ?: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=40&h=40&fit=crop&crop=face' }}"
                                                                alt="{{ $article->user->name }}"
                                                                class="w-8 h-8 rounded-full"
                                                        >
                                                        <span class="text-sm text-gray-600">{{ $article->user->name }}</span>
                                                    </div>
                                                    <div class="flex space-x-4 text-sm">
                                                        <button
                                                                onclick="handleLike(this)"
                                                                class="flex items-center space-x-1 text-gray-600 hover:text-red-500 transition"
                                                        >
                                                            <i class="far fa-heart"></i>
                                                            <span>{{ $article->likes_count }}</span>
                                                        </button>
                                                        <button
                                                                onclick="handleComment()"
                                                                class="flex items-center space-x-1 text-gray-600 hover:text-blue-500 transition"
                                                        >
                                                            <i class="far fa-comment"></i>
                                                            <span>{{ $article->comments_count }}</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                        </article>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <i class="fas fa-search text-4xl text-gray-400 mb-4"></i>
                            <h3 class="mt-4 text-xl font-medium text-gray-900">No articles found</h3>
                            <p class="mt-2 text-gray-500">Try adjusting your search or filter criteria.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($articles->hasPages())
                    <div class="mt-12">
                        {{ $articles->links() }}
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-1">
                <!-- Categories -->
                <div class="sidebar-card bg-white p-6 mb-8">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-folder text-indigo-600 text-xl mr-3"></i>
                        <h3 class="text-xl font-bold text-gray-900">Categories</h3>
                    </div>
                    <ul class="space-y-3">
                        @foreach($categories as $category)
                            <li>
                                <button
                                        wire:click="$set('category', '{{ $category->slug }}')"
                                        class="flex justify-between items-center w-full text-left text-gray-700 hover:text-indigo-600 transition"
                                >
                                    <span class="flex items-center">
                                        <i class="fas fa-folder text-indigo-500 mr-2"></i>
                                        {{ $category->name }}
                                    </span>
                                    <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs">
                                        {{ $category->articles_count }}
                                    </span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Recent Posts -->
                <div class="sidebar-card bg-white p-6 mb-8">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-clock text-indigo-600 text-xl mr-3"></i>
                        <h3 class="text-xl font-bold text-gray-900">Recent Posts</h3>
                    </div>
                    <div class="space-y-4">
                        @foreach($recentArticles as $recentArticle)
                            <a href="{{ route('home') }}" class="flex items-start space-x-3 group">
                                <img
                                        src="{{ $recentArticle->featured_image ?: 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=60&h=60&fit=crop' }}"
                                        alt="{{ $recentArticle->title }}"
                                        class="w-16 h-16 object-cover rounded-md flex-shrink-0"
                                >
                                <div>
                                    <h4 class="font-semibold text-gray-900 group-hover:text-indigo-600 transition text-sm article-title">
                                        {{ $recentArticle->title }}
                                    </h4>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $recentArticle->published_at?->format('M j, Y') }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Tags Cloud -->
                <div class="sidebar-card bg-white p-6">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-tags text-indigo-600 text-xl mr-3"></i>
                        <h3 class="text-xl font-bold text-gray-900">Popular Tags</h3>
                    </div>
                    <div class="tag-cloud flex flex-wrap gap-2">
                        @foreach($popularTags as $tag)
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm cursor-pointer">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
