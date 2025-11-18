<div>
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-12">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold mb-4">{{ $category->name }}</h1>
            <p class="text-xl opacity-90">{{ $category->description }}</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <div class="lg:w-3/4">
                <!-- Filters -->
                <div class="bg-white rounded-lg shadow p-6 mb-8">
                    <div class="flex flex-col md:flex-row gap-4 justify-between items-center">
                        <div>
                            <p class="text-gray-600">
                                Showing {{ $articles->total() }} article{{ $articles->total() === 1 ? '' : 's' }} in
                                this category
                            </p>
                        </div>
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
                        <p class="text-gray-600">There are no articles in this category yet.</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/4">
                <!-- Category Info -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">About this Category</h3>
                    <p class="text-gray-600 mb-4">{{ $category->description }}</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9m0 0v12m0 0h6m-6 0h6"/>
                        </svg>
                        {{ $articles->total() }} article{{ $articles->total() === 1 ? '' : 's' }}
                    </div>
                </div>

                <!-- Back to Categories -->
                <div class="bg-white rounded-lg shadow p-6">
                    <a
                            href="{{ route('articles.index') }}"
                            class="flex items-center text-blue-600 hover:text-blue-800 font-medium"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to All Categories
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>