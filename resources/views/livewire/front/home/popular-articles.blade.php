<div class="bg-white sidebar-card p-6 mb-8">
    <div class="flex items-center mb-4">
        <i class="fas fa-chart-line text-indigo-600 text-xl mr-3"></i>
        <h3 class="text-xl font-bold text-gray-900">Trending Now</h3>
    </div>
    <div class="space-y-4">
        @foreach($articles as $index => $article)
            <a href="{{ route('home') }}" class="flex items-start space-x-3 group">
                <span class="text-xl font-bold text-indigo-600 mt-1">{{ $index + 1 }}</span>
                <div>
                    <h4 class="font-semibold text-gray-900 group-hover:text-indigo-600 transition article-title">{{ $article->title }}</h4>
                    <div class="flex items-center mt-1 text-xs text-gray-500">
                        <span>{{ number_format($article->views) }} views</span>
                        <span class="mx-2">•</span>
                        <span>{{ $article->published_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>