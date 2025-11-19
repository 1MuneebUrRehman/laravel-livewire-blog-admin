<div>
    <article class="article-card bg-white overflow-hidden">
        <div class="">
            <div class="relative">
                <img
                        src="{{ $article->featured_image ?: 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=400&h=250&fit=crop' }}"
                        alt="{{ $article->title }}"
                        class="w-full h-48 object-cover"
                >
                <span class="absolute top-4 left-4 bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-semibold">
                    {{ $article->category->name }}
                </span>
            </div>
            <div class="p-6">
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
</div>