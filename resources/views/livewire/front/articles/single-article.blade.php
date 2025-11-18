<div>
    <!-- Article Header -->
    <div class="bg-white border-b">
        <div class="container mx-auto px-4 py-8">
            <nav class="flex items-center text-sm text-gray-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-blue-600">Home</a>
                <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('articles.index') }}" class="hover:text-blue-600">Articles</a>
                <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-900">{{ $article->title }}</span>
            </nav>

            <div class="max-w-4xl mx-auto">
                @if($article->featured_image)
                    <img
                            src="{{ Storage::url($article->featured_image) }}"
                            alt="{{ $article->title }}"
                            class="w-full h-64 md:h-96 object-cover rounded-lg mb-8"
                    >
                @endif

                <div class="text-center mb-8">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $article->title }}</h1>

                    <div class="flex flex-wrap items-center justify-center gap-4 text-sm text-gray-500 mb-4">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            {{ $article->user->name }}
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $article->created_at->format('F d, Y') }}
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            {{ $article->views }} views
                        </div>
                    </div>

                    <a
                            href="{{ route('categories.show', $article->category) }}"
                            class="inline-block bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-medium hover:bg-blue-200 transition duration-300"
                    >
                        {{ $article->category->name }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Article Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <div class="lg:w-2/3">
                <article class="bg-white rounded-lg shadow-sm border p-8 mb-8">
                    <div class="prose max-w-none">
                        {!! $article->content !!}
                    </div>

                    <!-- Tags -->
                    @if($article->tags->count() > 0)
                        <div class="mt-8 pt-6 border-t">
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Tags:</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach($article->tags as $tag)
                                    <a
                                            href="{{ route('search', ['q' => $tag->name]) }}"
                                            class="inline-block bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full hover:bg-blue-100 hover:text-blue-800 transition duration-300"
                                    >
                                        {{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </article>

                <!-- Comments -->
                <livewire:front.articles.article-comments :article="$article"/>
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/3">
                <!-- Author Info -->
                <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">About the Author</h3>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                            <span class="text-blue-600 font-bold text-lg">{{ substr($article->user->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">{{ $article->user->name }}</h4>
                            <p class="text-sm text-gray-600">Blog Author</p>
                        </div>
                    </div>
                </div>

                <!-- Related Articles -->
                @if($relatedArticles->count() > 0)
                    <div class="bg-white rounded-lg shadow-sm border p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Related Articles</h3>
                        <div class="space-y-4">
                            @foreach($relatedArticles as $related)
                                <article class="flex items-start space-x-3">
                                    @if($related->featured_image)
                                        <img
                                                src="{{ Storage::url($related->featured_image) }}"
                                                alt="{{ $related->title }}"
                                                class="w-16 h-16 object-cover rounded-lg flex-shrink-0"
                                        >
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900 line-clamp-2">
                                            <a
                                                    href="{{ route('articles.show', $related) }}"
                                                    class="hover:text-blue-600 transition duration-300"
                                            >
                                                {{ $related->title }}
                                            </a>
                                        </h4>
                                        <p class="text-xs text-gray-500 mt-1">{{ $related->created_at->format('M d, Y') }}</p>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>