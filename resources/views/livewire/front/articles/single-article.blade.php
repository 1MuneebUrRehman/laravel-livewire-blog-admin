<div class="bg-gray-50 min-h-screen">
    <!-- Reading Progress Bar -->
    <div id="reading-progress"
         class="h-1 bg-gradient-to-r from-indigo-600 to-purple-600 fixed top-0 left-0 z-50 transition-all duration-200"></div>

    <!-- Page Header -->
    <div class="page-header-gradient text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between">
                <div>
                    <nav class="flex mb-4" aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-2 text-sm text-indigo-200">
                            <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                            <li><i class="fas fa-chevron-right text-xs"></i></li>
                            <li><a href="{{ route('articles') }}" class="hover:text-white transition">Articles</a></li>
                            <li><i class="fas fa-chevron-right text-xs"></i></li>
                            <li class="text-white">{{ $article->category->name }}</li>
                        </ol>
                    </nav>
                    <h1 class="text-4xl font-bold mb-2">{{ $article->title }}</h1>
                    <p class="text-lg opacity-90 max-w-2xl">{{ $article->excerpt }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 -mt-6">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content Area -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <!-- Article Header -->
                    <div class="p-8 border-b border-gray-200">
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $article->category->name }}
                            </span>
                            <span class="text-gray-500 text-sm">
                                {{ $article->published_at->format('F j, Y') }}
                            </span>
                            <span class="text-gray-500 text-sm flex items-center">
                                <i class="fas fa-clock mr-1"></i> {{ $article->reading_time }} min read
                            </span>
                            <span class="text-gray-500 text-sm flex items-center">
                                <i class="fas fa-eye mr-1"></i> {{ $article->views }} views
                            </span>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <img src="{{ $article->user->avatar }}" alt="Author" class="w-12 h-12 rounded-full">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $article->user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $article->user->title ?? 'Contributor' }}</p>
                                </div>
                            </div>
                            <div class="flex space-x-4">
                                <button wire:click="toggleLike"
                                        class="flex items-center space-x-2 text-gray-600 hover:text-red-500 transition">
                                    <i class="far fa-heart {{ $article->isLikedBy(auth()->id()) ? 'fas text-red-500' : '' }}"></i>
                                    <span>{{ $article->likes_count }}</span>
                                </button>
                                <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-500 transition">
                                    <i class="far fa-bookmark"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    @if($article->featured_image)
                        <div class="p-8 pb-0">
                            <img src="{{ $article->featured_image }}" alt="{{ $article->title }}"
                                 class="w-full h-auto rounded-lg">
                        </div>
                    @endif

                    <!-- Article Content -->
                    <div class="p-8 prose prose-lg max-w-none">
                        {!! $article->content !!}
                    </div>

                    <!-- Tags -->
                    <div class="p-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($article->tags as $tag)
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm cursor-pointer hover:bg-indigo-600 hover:text-white transition">
                                {{ $tag->name }}
                            </span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Share Buttons -->
                    <div class="p-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Share this article</h3>
                        <div class="flex flex-wrap gap-4">
                            <!-- Twitter Share -->
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode(url()->current()) }}"
                               target="_blank"
                               class="flex items-center space-x-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                <i class="fab fa-twitter"></i>
                                <span>Twitter</span>
                            </a>

                            <!-- LinkedIn Share -->
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                               target="_blank"
                               class="flex items-center space-x-2 bg-blue-800 text-white px-4 py-2 rounded-lg hover:bg-blue-900 transition">
                                <i class="fab fa-linkedin-in"></i>
                                <span>LinkedIn</span>
                            </a>

                            <!-- Facebook Share -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                               target="_blank"
                               class="flex items-center space-x-2 bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-900 transition">
                                <i class="fab fa-facebook-f"></i>
                                <span>Facebook</span>
                            </a>

                            <!-- Email Share -->
                            <a href="mailto:?subject={{ urlencode($article->title) }}&body={{ urlencode('Check out this article: ' . url()->current()) }}"
                               class="flex items-center space-x-2 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                                <i class="far fa-envelope"></i>
                                <span>Email</span>
                            </a>
                        </div>
                    </div>

                    <!-- Author Card -->
                    <div class="p-8 pt-6 border-t border-gray-200">
                        <div class="bg-gray-50 rounded-xl p-6">
                            <div class="flex items-center space-x-4">
                                <img src="{{ $article->user->avatar }}" alt="Author" class="w-16 h-16 rounded-full">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">About the Author</h3>
                                    <p class="text-gray-600">{{ $article->user->bio ?? 'No bio available.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Articles -->
                @if($relatedArticles->count() > 0)
                    <section class="mt-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Articles</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($relatedArticles as $relatedArticle)
                                <article
                                        class="article-card bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition-shadow">
                                    <div class="relative">
                                        <img src="{{ $relatedArticle->featured_image ?? 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400&h=250&fit=crop' }}"
                                             alt="Article thumbnail"
                                             class="w-full h-48 object-cover">
                                        <span class="absolute top-4 left-4 bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $relatedArticle->category->name }}
                                </span>
                                    </div>
                                    <div class="p-6">
                                        <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-indigo-600 transition cursor-pointer article-title">
                                            <a href="{{ route('articles.show', $relatedArticle->slug) }}">
                                                {{ $relatedArticle->title }}
                                            </a>
                                        </h3>
                                        <p class="text-gray-600 mb-4 text-sm">
                                            {{ Str::limit($relatedArticle->excerpt, 100) }}
                                        </p>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-2">
                                                <img src="{{ $relatedArticle->user->avatar }}" alt="Author"
                                                     class="w-6 h-6 rounded-full">
                                                <span class="text-sm text-gray-600">{{ $relatedArticle->user->name }}</span>
                                            </div>
                                            <span class="text-sm text-gray-500">{{ $relatedArticle->published_at->format('M j, Y') }}</span>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </section>
                @endif

                <!-- Comments Section -->
                <livewire:front.articles.article-comments :article="$article"/>
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-1">
                <div class="sticky-sidebar space-y-8">
                    <livewire:front.articles.article-sidebar
                            :categories="$categories"
                            :recentArticles="$recentArticles"
                            :popularTags="$popularTags"
                    />
                </div>
            </aside>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Reading progress bar
        window.addEventListener('scroll', function () {
            const winHeight = window.innerHeight;
            const docHeight = document.documentElement.scrollHeight;
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const scrollPercent = (scrollTop / (docHeight - winHeight)) * 100;

            document.getElementById('reading-progress').style.width = scrollPercent + '%';
        });

        // Like button functionality
        document.addEventListener('DOMContentLoaded', function () {
            const likeBtn = document.querySelector('[wire\\:click="toggleLike"]');
            if (likeBtn) {
                likeBtn.addEventListener('click', function () {
                    const likeCount = this.querySelector('span');
                    const icon = this.querySelector('i');
                    const currentCount = parseInt(likeCount.textContent);

                    if (this.classList.contains('text-red-500')) {
                        this.classList.remove('text-red-500');
                        likeCount.textContent = currentCount - 1;
                    } else {
                        this.classList.add('text-red-500');
                        likeCount.textContent = currentCount + 1;
                    }
                });
            }
        });
    </script>
@endpush