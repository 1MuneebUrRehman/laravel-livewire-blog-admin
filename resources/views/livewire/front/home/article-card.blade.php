<article class="bg-white article-card overflow-hidden card-hover">
    <div class="relative">
        <img src="{{ $article->featured_image ?? 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400&h=250&fit=crop' }}"
             alt="{{ $article->title }}" class="w-full h-48 object-cover">
        @if($showCategory)
            <span class="absolute top-4 left-4 bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">{{ $article->category->name }}</span>
        @endif
    </div>
    <div class="p-6">
        <div class="flex flex-wrap items-center gap-4 mb-3">
            <span class="text-gray-500 text-sm">{{ $article->published_at->format('M d, Y') }}</span>
            <span class="text-gray-500 text-sm flex items-center">
                <i class="fas fa-clock mr-1"></i> {{ $article->read_time }} min
            </span>
        </div>
        <h4 class="text-xl font-bold text-gray-900 mb-3 hover:text-indigo-600 transition cursor-pointer article-title">
            <a href="{{ route('home') }}">{{ $article->title }}</a>
        </h4>
        <p class="text-gray-600 mb-4">
            {{ Str::limit($article->excerpt, 100) }}
        </p>
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center space-x-2">
                <img src="{{ $article->user->avatar ?? 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=30&h=30&fit=crop&crop=face' }}"
                     alt="{{ $article->user->name }}" class="w-8 h-8 rounded-full">
                <span class="text-sm text-gray-700">{{ $article->user->name }}</span>
            </div>
            <a href="{{ route('home') }}"
               class="text-indigo-600 font-semibold hover:text-indigo-700 transition text-sm">Read More →</a>
        </div>
    </div>
</article>