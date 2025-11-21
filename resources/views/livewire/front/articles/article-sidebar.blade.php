<div class="space-y-8">
    <!-- Categories -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center mb-6">
            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center mr-3 shadow-sm">
                <i class="fas fa-folder text-white text-sm"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900">Categories</h3>
        </div>
        <ul class="space-y-3">
            @foreach($categories as $category)
                <li>
                    <button
                            wire:click="toggleCategory('{{ $category->slug }}')"
                            class="flex justify-between items-center w-full text-left p-3 rounded-xl text-gray-700 hover:text-indigo-600 transition-all duration-300 group hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 border border-transparent hover:border-indigo-100 {{ in_array($category->slug, $selectedCategories) ? 'bg-gradient-to-r from-indigo-50 to-blue-50 text-indigo-600 border-indigo-200' : '' }}"
                    >
                        <span class="flex items-center font-medium">
                            @if($category->slug === 'technology')
                                <i class="fas fa-laptop-code text-indigo-500 mr-3 text-lg"></i>
                            @elseif($category->slug === 'marketing')
                                <i class="fas fa-chart-line text-blue-500 mr-3 text-lg"></i>
                            @elseif($category->slug === 'finance')
                                <i class="fas fa-chart-pie text-green-500 mr-3 text-lg"></i>
                            @elseif($category->slug === 'leadership')
                                <i class="fas fa-users text-yellow-500 mr-3 text-lg"></i>
                            @elseif($category->slug === 'innovation')
                                <i class="fas fa-lightbulb text-red-500 mr-3 text-lg"></i>
                            @else
                                <i class="fas fa-folder text-indigo-500 mr-3 text-lg"></i>
                            @endif
                            {{ $category->name }}
                        </span>
                        <span class="bg-gray-100 text-gray-600 px-3 py-1.5 rounded-full text-xs font-semibold group-hover:bg-indigo-100 group-hover:text-indigo-600 transition-all duration-300 shadow-sm {{ in_array($category->slug, $selectedCategories) ? 'bg-indigo-100 text-indigo-600' : '' }}">
                            {{ $category->articles_count }}
                        </span>
                    </button>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Recent Posts -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center mb-6">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-lg flex items-center justify-center mr-3 shadow-sm">
                <i class="fas fa-clock text-white text-sm"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900">Recent Posts</h3>
        </div>
        <div class="space-y-5">
            @foreach($recentArticles as $recentArticle)
                <a href="{{ route('articles.show', $recentArticle->slug) }}"
                   class="flex items-start space-x-4 group p-2 rounded-xl hover:bg-gradient-to-r hover:from-gray-50 hover:to-blue-50 transition-all duration-300">
                    <div class="relative flex-shrink-0">
                        <img
                                src="{{ $recentArticle->featured_image ?: 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=80&h=80&fit=crop&crop=center' }}"
                                alt="{{ $recentArticle->title }}"
                                class="w-16 h-16 object-cover rounded-xl shadow-sm group-hover:shadow-md transition-all duration-300"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors duration-300 text-sm leading-tight line-clamp-2 mb-1">
                            {{ $recentArticle->title }}
                        </h4>
                        <div class="flex items-center text-xs text-gray-500">
                            <i class="far fa-calendar mr-1.5"></i>
                            <span>{{ $recentArticle->published_at?->format('M j, Y') }}</span>
                        </div>
                        @if($recentArticle->category)
                            <span class="inline-block mt-2 px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs">
                                {{ $recentArticle->category->name }}
                            </span>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Tags Cloud -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center mb-6">
            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center mr-3 shadow-sm">
                <i class="fas fa-tags text-white text-sm"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900">Popular Tags</h3>
        </div>
        <div class="flex flex-wrap gap-3">
            @foreach($popularTags as $tag)
                <button
                        wire:click="toggleTag('{{ $tag->slug }}')"
                        class="bg-gradient-to-r from-gray-100 to-gray-50 text-gray-700 px-4 py-2 rounded-xl text-sm font-medium cursor-pointer hover:from-indigo-50 hover:to-blue-50 hover:text-indigo-600 hover:shadow-sm transition-all duration-300 border border-gray-200 hover:border-indigo-200 transform hover:-translate-y-0.5 {{ in_array($tag->slug, $selectedTags) ? 'from-indigo-50 to-blue-50 text-indigo-600 border-indigo-200' : '' }}"
                >
                    #{{ $tag->name }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Newsletter Signup -->
    <div class="bg-gradient-to-br from-indigo-600 to-purple-700 rounded-2xl p-6 text-white shadow-lg">
        <div class="text-center">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-envelope text-white text-lg"></i>
            </div>
            <h3 class="text-lg font-bold mb-2">Stay Updated</h3>
            <p class="text-indigo-100 text-sm mb-4">Get the latest articles delivered to your inbox</p>
            <div class="space-y-3">
                <input
                        type="email"
                        placeholder="Enter your email"
                        class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-indigo-200 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-transparent"
                >
                <button class="w-full bg-white text-indigo-600 font-semibold py-3 rounded-lg hover:bg-gray-100 transition-colors duration-300 shadow-lg">
                    Subscribe
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        // Listen for category selection from sidebar
        Livewire.on('category-selected', (data) => {
            // This will be handled by the parent component if needed
            console.log('Category selected:', data.category);
        });

        // Listen for tag selection from sidebar
        Livewire.on('tag-selected', (data) => {
            // This will be handled by the parent component if needed
            console.log('Tag selected:', data.tag);
        });
    });
</script>