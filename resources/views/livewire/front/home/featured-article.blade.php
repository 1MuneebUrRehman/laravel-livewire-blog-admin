@if($article)
    <section class="mb-16">
        <div class="flex items-center justify-between mb-8">
            <h3 class="text-3xl font-bold text-gray-900">Featured Article</h3>
            <a href="{{ route('home') }}"
               class="text-indigo-600 font-medium hover:text-indigo-700 transition flex items-center">
                View All <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <article class="bg-white article-card overflow-hidden card-hover">
            <div class="md:flex">
                <div class="md:w-2/5">
                    <img src="{{ $article->featured_image ?? 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800&h=500&fit=crop' }}"
                         alt="{{ $article->title }}" class="w-full h-64 md:h-full object-cover">
                </div>
                <div class="md:w-3/5 p-6 md:p-8">
                    <div class="flex flex-wrap items-center gap-4 mb-4">
                        <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm font-semibold">{{ $article->category->name }}</span>
                        <span class="text-gray-500 text-sm">{{ $article->published_at->format('F d, Y') }}</span>
                        <span class="text-gray-500 text-sm flex items-center">
                        <i class="fas fa-clock mr-1"></i> {{ $article->read_time }} min read
                    </span>
                    </div>
                    <h4 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 hover:text-indigo-600 transition cursor-pointer article-title">
                        <a href="{{ route('home') }}">{{ $article->title }}</a>
                    </h4>
                    <p class="text-gray-600 text-lg leading-relaxed mb-6">
                        {{ $article->excerpt }}
                    </p>
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <img src="{{ $article->user->avatar ?? 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=40&h=40&fit=crop&crop=face' }}"
                                     alt="{{ $article->user->name }}" class="w-10 h-10 rounded-full">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $article->user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $article->user->role ?? 'Contributor' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex space-x-4">
                            <button wire:click="like"
                                    class="flex items-center space-x-2 {{ $article->is_liked ? 'text-red-500' : 'text-gray-600' }} hover:text-red-500 transition">
                                <i class="{{ $article->is_liked ? 'fas' : 'far' }} fa-heart"></i>
                                <span>{{ $article->likes_count }}</span>
                            </button>
                            <a href="{{ route('home') }}"
                               class="flex items-center space-x-2 text-gray-600 hover:text-blue-500 transition">
                                <i class="far fa-comment"></i>
                                <span>{{ $article->comments_count }}</span>
                            </a>
                            <button onclick="shareArticle('{{ $article->title }}', '{{ route('home') }}')"
                                    class="flex items-center space-x-2 text-gray-600 hover:text-green-500 transition">
                                <i class="far fa-share-square"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
@endif