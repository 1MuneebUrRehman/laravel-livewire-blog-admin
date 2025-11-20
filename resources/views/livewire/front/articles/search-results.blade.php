<div class="bg-gray-50 min-h-screen">
    <!-- Page Header - Matching All Articles Design -->
    <div class="page-header-gradient text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between">
                <div>
                    <h1 class="text-4xl font-bold mb-2">Search Results</h1>
                    <p class="text-lg opacity-90 max-w-2xl">
                        @if($articles->total() > 0)
                            Found {{ $articles->total() }} results for "{{ $query ?: 'all articles' }}"
                        @else
                            No results found for "{{ $query }}"
                        @endif
                    </p>
                </div>
                <div class="mt-4 md:mt-0">
                    <div class="relative">
                        <input
                                type="text"
                                wire:model.live="query"
                                class="w-full md:w-80 px-4 py-3 pl-10 pr-4 rounded-lg border border-white/20 bg-white/10 backdrop-blur-sm text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-transparent"
                                placeholder="Search articles..."
                        >
                        <i class="fas fa-search text-white/70 absolute left-3 top-3.5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 -mt-6">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content Area -->
            <div class="lg:col-span-3">
                <!-- Filters and Controls -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <!-- Category Filters -->
                        <div class="flex flex-wrap gap-2">
                            <button
                                    wire:click="category = ''"
                                    class="px-4 py-2 rounded-full text-sm font-medium transition {{ !$category ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                            >
                                All Results
                            </button>
                            @foreach($categories as $cat)
                                <button
                                        wire:click="category = '{{ $cat->slug }}'"
                                        class="px-4 py-2 rounded-full text-sm font-medium transition {{ $category === $cat->slug ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                                >
                                    {{ $cat->name }}
                                </button>
                            @endforeach
                        </div>

                        <!-- Sort and View Controls -->
                        <div class="flex items-center space-x-4">
                            <!-- Sort Dropdown -->
                            <div class="flex items-center space-x-2">
                                <span class="text-gray-600 text-sm">Sort by:</span>
                                <div class="relative">
                                    <select
                                            wire:model.live="sort"
                                            class="appearance-none w-full md:w-auto px-4 py-2 pr-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent bg-white text-sm"
                                    >
                                        <option value="relevance">Relevance</option>
                                        <option value="newest">Newest First</option>
                                        <option value="oldest">Oldest First</option>
                                        <option value="popular">Most Popular</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <i class="fas fa-chevron-down text-xs"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- View Toggle -->
                            <div class="flex items-center space-x-2 border-l border-gray-200 pl-4">
                                <span class="text-gray-600 text-sm hidden sm:block">View:</span>
                                <button
                                        wire:click="setViewMode('grid')"
                                        class="p-2 rounded-md {{ $viewMode === 'grid' ? 'bg-indigo-100 text-indigo-700' : 'text-gray-500 hover:bg-gray-100' }}"
                                >
                                    <i class="fas fa-th"></i>
                                </button>
                                <button
                                        wire:click="setViewMode('list')"
                                        class="p-2 rounded-md {{ $viewMode === 'list' ? 'bg-indigo-100 text-indigo-700' : 'text-gray-500 hover:bg-gray-100' }}"
                                >
                                    <i class="fas fa-list"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Results Grid/List -->
                <div class="@if($viewMode === 'grid') grid grid-cols-1 md:grid-cols-2 gap-6 @else space-y-6 @endif">
                    @forelse($articles as $article)
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                            <div class="@if($viewMode === 'grid') flex flex-col @else flex flex-col md:flex-row @endif">
                                @if($viewMode === 'list')
                                    <div class="md:w-1/3">
                                        @if($article->featured_image)
                                            <img src="{{ $article->featured_image }}" alt="{{ $article->title }}"
                                                 class="w-full h-48 object-cover">
                                        @else
                                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                                <i class="fas fa-newspaper text-gray-400 text-3xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                <div class="@if($viewMode === 'grid') p-6 @else md:w-2/3 p-6 @endif">
                                    @if($viewMode === 'grid' && $article->featured_image)
                                        <img src="{{ $article->featured_image }}" alt="{{ $article->title }}"
                                             class="w-full h-48 object-cover rounded-lg mb-4">
                                    @endif

                                    <div class="flex items-center space-x-4 mb-3">
                                        <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            {{ $article->category->name }}
                                        </span>
                                        <span class="text-gray-500 text-sm">
                                            {{ $article->published_at ? $article->published_at->format('F j, Y') : 'Not published' }}
                                        </span>
                                        <span class="text-gray-500 text-sm flex items-center">
                                            <i class="fas fa-clock mr-1"></i> {{ $article->reading_time }} min read
                                        </span>
                                    </div>

                                    <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-indigo-600 transition cursor-pointer">
                                        <a href="{{ route('articles.show', $article->slug) }}">
                                            {!! highlightText($article->title, $query) !!}
                                        </a>
                                    </h3>

                                    <p class="text-gray-600 mb-4">
                                        {!! highlightText(Str::limit($article->excerpt, 200), $query) !!}
                                    </p>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            @if($article->user->avatar)
                                                <img src="{{ $article->user->avatar }}" alt="{{ $article->user->name }}"
                                                     class="w-6 h-6 rounded-full">
                                            @else
                                                <div class="w-6 h-6 bg-gray-300 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-user text-gray-600 text-xs"></i>
                                                </div>
                                            @endif
                                            <span class="text-sm text-gray-600">{{ $article->user->name }}</span>
                                        </div>
                                        <div class="flex space-x-4 text-sm">
                                            <button class="flex items-center space-x-1 text-gray-600 hover:text-red-500 transition">
                                                <i class="far fa-heart"></i>
                                                <span>{{ $article->likes_count }}</span>
                                            </button>
                                            <a
                                                    href="{{ route('articles.show', $article->slug) }}#comments"
                                                    class="flex items-center space-x-1 text-gray-600 hover:text-blue-500 transition"
                                            >
                                                <i class="far fa-comment"></i>
                                                <span>{{ $article->comments_count }}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-xl shadow-sm p-12 text-center col-span-2">
                            <i class="fas fa-search text-gray-400 text-5xl mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">No results found</h3>
                            <p class="text-gray-600 mb-6">Try adjusting your search terms or filters</p>
                            <button
                                    wire:click="$set('query', '')"
                                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-indigo-700 transition"
                            >
                                Clear Search
                            </button>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($articles->hasPages())
                    <div class="mt-12 flex justify-center">
                        <nav class="flex items-center space-x-2">
                            @if($articles->onFirstPage())
                                <span class="px-4 py-2 rounded-md bg-gray-100 text-gray-400 text-sm cursor-not-allowed">
                                    <i class="fas fa-chevron-left mr-2"></i> Previous
                                </span>
                            @else
                                <button
                                        wire:click="previousPage"
                                        class="px-4 py-2 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 transition text-sm"
                                >
                                    <i class="fas fa-chevron-left mr-2"></i> Previous
                                </button>
                            @endif

                            @foreach($articles->links()->elements as $element)
                                @if(is_string($element))
                                    <span class="px-2 text-gray-500">...</span>
                                @endif

                                @if(is_array($element))
                                    @foreach($element as $page => $url)
                                        @if($page == $articles->currentPage())
                                            <span class="px-4 py-2 rounded-md bg-indigo-600 text-white text-sm">
                                                {{ $page }}
                                            </span>
                                        @else
                                            <button
                                                    wire:click="gotoPage({{ $page }})"
                                                    class="px-4 py-2 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 transition text-sm"
                                            >
                                                {{ $page }}
                                            </button>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                            @if($articles->hasMorePages())
                                <button
                                        wire:click="nextPage"
                                        class="px-4 py-2 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 transition text-sm"
                                >
                                    Next <i class="fas fa-chevron-right ml-2"></i>
                                </button>
                            @else
                                <span class="px-4 py-2 rounded-md bg-gray-100 text-gray-400 text-sm cursor-not-allowed">
                                    Next <i class="fas fa-chevron-right ml-2"></i>
                                </span>
                            @endif
                        </nav>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-1">
                <!-- Popular Tags -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Popular Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($popularTags as $tag)
                            <span
                                    wire:click="$set('query', '{{ $tag->name }}')"
                                    class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm cursor-pointer hover:bg-indigo-100 hover:text-indigo-700 transition"
                            >
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <!-- Recent Articles -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Recent Articles</h3>
                    <div class="space-y-4">
                        @foreach($recentArticles as $recentArticle)
                            <a
                                    href="{{ route('articles.show', $recentArticle->slug) }}"
                                    class="flex items-start space-x-3 group"
                            >
                                @if($recentArticle->featured_image)
                                    <img src="{{ $recentArticle->featured_image }}" alt="{{ $recentArticle->title }}"
                                         class="w-12 h-12 object-cover rounded-lg">
                                @else
                                    <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-newspaper text-gray-400"></i>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900 group-hover:text-indigo-600 transition leading-tight">
                                        {{ Str::limit($recentArticle->title, 50) }}
                                    </h4>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $recentArticle->published_at ? $recentArticle->published_at->format('M j') : 'Draft' }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .page-header-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .search-highlight {
            background-color: #fef3c7;
            padding: 0 2px;
            border-radius: 2px;
        }
    </style>
@endpush