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
                            class="flex justify-between items-center w-full text-left text-gray-700 hover:text-indigo-600 transition group"
                    >
                        <span class="flex items-center">
                            @if($category->slug === 'technology')
                                <i class="fas fa-laptop-code text-indigo-500 mr-2"></i>
                            @elseif($category->slug === 'marketing')
                                <i class="fas fa-chart-line text-blue-500 mr-2"></i>
                            @elseif($category->slug === 'finance')
                                <i class="fas fa-chart-pie text-green-500 mr-2"></i>
                            @elseif($category->slug === 'leadership')
                                <i class="fas fa-users text-yellow-500 mr-2"></i>
                            @elseif($category->slug === 'innovation')
                                <i class="fas fa-lightbulb text-red-500 mr-2"></i>
                            @else
                                <i class="fas fa-folder text-indigo-500 mr-2"></i>
                            @endif
                            {{ $category->name }}
                        </span>
                        <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs group-hover:bg-indigo-100 group-hover:text-indigo-600 transition">
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
                <button
                        wire:click="$dispatch('tag-selected', { tag: '{{ $tag->slug }}' })"
                        class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm cursor-pointer hover:bg-indigo-100 hover:text-indigo-600 transition"
                >
                    {{ $tag->name }}
                </button>
            @endforeach
        </div>
    </div>
</div>