<div>
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-12">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold mb-4">Search Results</h1>

            <!-- Search Box -->
            <div class="max-w-2xl mx-auto">
                <form wire:submit.prevent class="relative">
                    <input
                            type="text"
                            wire:model.live="query"
                            placeholder="Search articles, categories, tags..."
                            class="w-full px-6 py-4 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    <svg class="absolute right-4 top-4 w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </form>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        @if($query)
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Main Content -->
                <div class="lg:w-3/4">
                    <!-- Results Info and Filters -->
                    <div class="bg-white rounded-lg shadow p-6 mb-8">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div>
                                <p class="text-gray-600">
                                    Found {{ $resultsCount }} result{{ $resultsCount === 1 ? '' : 's' }} for
                                    "{{ $query }}"
                                </p>
                            </div>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <select
                                        wire:model.live="category"
                                        class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                >
                                    <option value="">All Categories</option>
                                    @php
                                        $categories = \App\Models\Category::all();
                                    @endphp
                                    @foreach($categories as $categoryItem)
                                        <option value="{{ $categoryItem->slug }}">{{ $categoryItem->name }}</option>
                                    @endforeach
                                </select>
                                <select
                                        wire:model.live="sort"
                                        class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                >
                                    <option value="latest">Latest</option>
                                    <option value="oldest">Oldest</option>
                                    <option value="popular">Most Popular</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Search Results -->
                    @if($articles->count() > 0)
                        <div class="space-y-6">
                            @foreach($articles as $article)
                                <article
                                        class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                                    <div class="p-6">
                                        <div class="flex flex-col lg:flex-row lg:items-start gap-6">
                                            @if($article->featured_image)
                                                <img
                                                        src="{{ Storage::url($article->featured_image) }}"
                                                        alt="{{ $article->title }}"
                                                        class="w-full lg:w-48 h-48 object-cover rounded-lg flex-shrink-0"
                                                >
                                            @else
                                                <div class="w-full lg:w-48 h-48 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-12 h-12 text-gray-400" fill="none"
                                                         stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                            @endif

                                            <div class="flex-1">
                                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                                    <span>{{ $article->created_at->format('M d, Y') }}</span>
                                                    <span class="mx-2">•</span>
                                                    <a
                                                            href="{{ route('categories.show', $article->category) }}"
                                                            class="text-blue-600 font-medium hover:text-blue-800"
                                                    >
                                                        {{ $article->category->name }}
                                                    </a>
                                                </div>

                                                <h3 class="text-xl font-bold text-gray-900 mb-3">
                                                    <a
                                                            href="{{ route('articles.show', $article) }}"
                                                            class="hover:text-blue-600 transition duration-300"
                                                    >
                                                        {{ $article->title }}
                                                    </a>
                                                </h3>

                                                <p class="text-gray-600 mb-4">
                                                    {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 200) }}
                                                </p>

                                                <!-- Tags -->
                                                @if($article->tags->count() > 0)
                                                    <div class="flex flex-wrap gap-1 mb-4">
                                                        @foreach($article->tags as $tag)
                                                            <a
                                                                    href="{{ route('search', ['q' => $tag->name]) }}"
                                                                    class="inline-block bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded hover:bg-blue-100 hover:text-blue-800 transition duration-300"
                                                            >
                                                                {{ $tag->name }}
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @endif

                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center">
                                                        <div class="text-sm">
                                                            <p class="text-gray-900 font-medium">{{ $article->user->name }}</p>
                                                        </div>
                                                    </div>
                                                    <a
                                                            href="{{ route('articles.show', $article) }}"
                                                            class="text-blue-600 hover:text-blue-800 font-medium text-sm"
                                                    >
                                                        Read more →
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $articles->links() }}
                        </div>
                    @else
                        <div class="bg-white rounded-lg shadow p-12 text-center">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">No results found</h3>
                            <p class="text-gray-600 mb-4">Try adjusting your search terms or filters</p>
                            <a
                                    href="{{ route('articles.index') }}"
                                    class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300"
                            >
                                Browse All Articles
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:w-1/4">
                    <!-- Search Tips -->
                    <div class="bg-white rounded-lg shadow p-6 mb-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Search Tips</h3>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                     stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7"/>
                                </svg>
                                Use specific keywords
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                     stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7"/>
                                </svg>
                                Try different search terms
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                     stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7"/>
                                </svg>
                                Check spelling
                            </li>
                        </ul>
                    </div>

                    <!-- Popular Tags -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Popular Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @php
                                $popularTags = \App\Models\Tag::withCount('articles')
                                    ->orderBy('articles_count', 'desc')
                                    ->limit(15)
                                    ->get();
                            @endphp
                            @foreach($popularTags as $tag)
                                <a
                                        href="{{ route('search', ['q' => $tag->name]) }}"
                                        class="inline-block bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full hover:bg-blue-100 hover:text-blue-800 transition duration-300"
                                >
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-24 h-24 text-gray-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Start Searching</h2>
                <p class="text-gray-600 mb-8">Enter keywords to find articles, categories, or tags</p>
                <a
                        href="{{ route('articles.index') }}"
                        class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300"
                >
                    Browse All Articles
                </a>
            </div>
        @endif
    </div>
</div>