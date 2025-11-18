<div>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">Welcome to Our Blog</h1>
                <p class="text-xl md:text-2xl mb-8 opacity-90">Discover amazing stories, creative ideas, and
                    professional insights</p>
                <a
                        href="{{ route('articles.index') }}"
                        class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300"
                >
                    Explore Articles
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Articles -->
    @if($featuredArticles->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Featured Articles</h2>
                    <p class="text-lg text-gray-600">Handpicked content you don't want to miss</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($featuredArticles as $article)
                        <article
                                class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
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
                                    <span>{{ $article->category->name }}</span>
                                </div>

                                <h3 class="text-xl font-bold text-gray-900 mb-3">
                                    <a
                                            href="{{ route('articles.show', $article) }}"
                                            class="hover:text-blue-600 transition duration-300"
                                    >
                                        {{ $article->title }}
                                    </a>
                                </h3>

                                <p class="text-gray-600 mb-4 line-clamp-3">
                                    {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 120) }}
                                </p>

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
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Recent Articles -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Recent Articles</h2>
                <p class="text-lg text-gray-600">Latest updates from our blog</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($recentArticles as $article)
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
                                <span>{{ $article->category->name }}</span>
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

            <div class="text-center mt-12">
                <a
                        href="{{ route('articles.index') }}"
                        class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300"
                >
                    View All Articles
                </a>
            </div>
        </div>
    </section>
</div>