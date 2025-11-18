<div>
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-12">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold mb-4">All Articles</h1>
            <p class="text-xl opacity-90">Discover our complete collection of articles</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <div class="lg:w-3/4">
                <!-- Filters -->
                <div class="bg-white rounded-lg shadow p-6 mb-8">
                    <div class="flex flex-col md:flex-row gap-4">
                        <!-- Search -->
                        <div class="flex-1">
                            <input
                                    type="text"
                                    wire:model.live="search"
                                    placeholder="Search articles..."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            >
                        </div>

                        <!-- Category Filter -->
                        <select
                                wire:model.live="category"
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="">All Categories</option>
                            @foreach($categories as $categoryItem)
                                <option value="{{ $categoryItem->slug }}">{{ $categoryItem->name }}
                                    ({{ $categoryItem->articles_count }})
                                </option>
                            @endforeach
                        </select>

                        <!-- Sort -->
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

                <!-- Articles Grid -->
                @if($articles->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($articles as $article)
                            <article
                                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                                @if($article->featured_image)
                                    <img
                                            src="{{ Storage::url($article->featured_image) }}"
                                            alt="{{ $article->title }}"
                                            class="w-full h-48 object-cover"
                                    >
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif

                                <div class="p-6">
                                    <div class="flex items-center text-sm text-gray-500 mb-2">
                                        <span>{{ $article->created_at->format('M d, Y') }}</span>
                                        <span class="mx-2">•</span>
                                        <span class="text-blue-600 font-medium">{{ $article->category->name }}</span>
                                    </div>

                                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                                        <a
                                                href="{{ route('articles.show', $article) }}"
                                                class="hover:text-blue-600 transition duration-300"
                                        >
                                            {{ $article->title }}
                                        </a>
                                    </h3>

                                    <p class="text-gray-600 mb-4 line-clamp-2">
                                        {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 100) }}
                                    </p>

                                    <!-- Tags -->
                                    @if($article->tags->count() > 0)
                                        <div class="flex flex-wrap gap-1 mb-4">
                                            @foreach($article->tags->take(3) as $tag)
                                                <span class="inline-block bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded">
                                                    {{ $tag->name }}
                                                </span>
                                            @endforeach
                                            @if($article->tags->count() > 3)
                                                <span class="inline-block bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded">
                                                    +{{ $article->tags->count() - 3 }} more
                                                </span>
                                            @endif
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
                                            Read more
                                        </a>
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
                        <h3 class="text-xl font-bold text-gray-900 mb-2">No articles found</h3>
                        <p class="text-gray-600">Try adjusting your search or filter criteria</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/4">
                <!-- Categories -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Categories</h3>
                    <div class="space-y-2">
                        @foreach($categories as $categoryItem)
                            <a
                                    href="{{ route('categories.show', $categoryItem) }}"
                                    class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-gray-50 transition duration-300"
                            >
                                <span class="text-gray-700">{{ $categoryItem->name }}</span>
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                                    {{ $categoryItem->articles_count }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Popular Tags -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Popular Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @php
                            $popularTags = \App\Models\Tag::withCount('articles')
                                ->orderBy('articles_count', 'desc')
                                ->limit(10)
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
    </div>
</div>