<div>
    <!-- Categories -->
    <div class="sidebar-card bg-white p-6 mb-8">
        <div class="flex items-center mb-4">
            <i class="fas fa-folder text-indigo-600 text-xl mr-3"></i>
            <h3 class="text-xl font-bold text-gray-900">Categories</h3>
        </div>
        <ul class="space-y-3">
            @foreach($categories as $category)
                <li>
                    <button
                            wire:click="$dispatch('category-selected', { category: '{{ $category->slug }}' })"
                            class="flex justify-between items-center w-full text-left text-gray-700 hover:text-indigo-600 transition"
                    >
                        <span class="flex items-center">
                            <i class="fas fa-folder text-indigo-500 mr-2"></i>
                            {{ $category->name }}
                        </span>
                        <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs">
                            {{ $category->articles_count }}
                        </span>
                    </button>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Recent Posts -->
    <div class="sidebar-card bg-white p-6 mb-8">
        <div class="flex items-center mb-4">
            <i class="fas fa-clock text-indigo-600 text-xl mr-3"></i>
            <h3 class="text-xl font-bold text-gray-900">Recent Posts</h3>
        </div>
        <div class="space-y-4">
            @foreach($recentArticles as $recentArticle)
                <a href="{{ route('home') }}" class="flex items-start space-x-3 group">
                    <img
                            src="{{ $recentArticle->featured_image ?: 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=60&h=60&fit=crop' }}"
                            alt="{{ $recentArticle->title }}"
                            class="w-16 h-16 object-cover rounded-md flex-shrink-0"
                    >
                    <div>
                        <h4 class="font-semibold text-gray-900 group-hover:text-indigo-600 transition text-sm article-title">
                            {{ $recentArticle->title }}
                        </h4>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $recentArticle->published_at?->format('M j, Y') }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Tags Cloud -->
    <div class="sidebar-card bg-white p-6">
        <div class="flex items-center mb-4">
            <i class="fas fa-tags text-indigo-600 text-xl mr-3"></i>
            <h3 class="text-xl font-bold text-gray-900">Popular Tags</h3>
        </div>
        <div class="tag-cloud flex flex-wrap gap-2">
            @foreach($popularTags as $tag)
                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm cursor-pointer">
                    {{ $tag->name }}
                </span>
            @endforeach
        </div>
    </div>
</div>