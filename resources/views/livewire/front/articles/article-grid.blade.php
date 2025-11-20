<div>
    <!-- Search Component -->
    <livewire:front.articles.article-search/>

    <!-- Filters and Results Header -->
    <div class="bg-white sidebar-card p-6 mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <!-- Left Side: Filters -->
            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                <!-- Sort Dropdown -->
                <div class="relative">
                    <select
                            wire:model.live="sortBy"
                            class="appearance-none w-full sm:w-48 px-4 py-3 pr-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent bg-white cursor-pointer"
                    >
                        <option value="latest">Latest Articles</option>
                        <option value="oldest">Oldest Articles</option>
                        <option value="popular">Most Popular</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>

                <!-- Clear Filters Button -->
                @if($selectedCategories || $selectedTags || $search)
                    <button
                            wire:click="clearFilters"
                            class="flex items-center gap-2 px-4 py-3 text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Clear All Filters
                    </button>
                @endif
            </div>

            <!-- Right Side: Results Count -->
            <div class="text-sm text-gray-600 bg-gray-50 px-4 py-2 rounded-lg">
                @if($articles->total() > 0)
                    Showing <span
                            class="font-semibold text-gray-900">{{ $articles->firstItem() }}-{{ $articles->lastItem() }}</span>
                    of <span class="font-semibold text-gray-900">{{ $articles->total() }}</span> articles
                    @if($search)
                        for "<span class="font-semibold text-indigo-600">"{{ $search }}"</span>"
                    @endif
                @else
                    No articles found
                    @if($search)
                        for "<span class="font-semibold text-indigo-600">"{{ $search }}"</span>"
                    @endif
                @endif
            </div>
        </div>
    </div>

    <!-- Articles Grid -->
    @if($articles->count())
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 mb-8">
            @foreach($articles as $article)
                <article
                        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 group">
                    <!-- Image Container -->
                    @if($article->featured_image)
                        <div class="relative overflow-hidden">
                            <img
                                    src="{{ $article->featured_image }}"
                                    alt="{{ $article->title }}"
                                    class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-300"
                            >
                            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                        </div>
                    @else
                        <div class="w-full h-52 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center group-hover:from-gray-200 group-hover:to-gray-300 transition-all duration-300">
                            <svg class="w-16 h-16 text-gray-400 group-hover:text-gray-500 transition-colors" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Category and Date -->
                        <div class="flex items-center justify-between mb-4">
                            @if($article->category)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700">
                                    {{ $article->category->name }}
                                </span>
                            @endif
                            <span class="text-sm text-gray-500">
                                @if($article->published_at)
                                    {{ $article->published_at->format('M j, Y') }}
                                @else
                                    <span class="text-amber-600">Draft</span>
                                @endif
                            </span>
                        </div>

                        <!-- Title -->
                        <h3 class="text-lg font-bold text-gray-900 mb-3 group-hover:text-indigo-600 transition-colors line-clamp-2">
                            <a href="{{ route('articles.show', $article->slug) }}" class="hover:no-underline">
                                @if($search)
                                    {!! highlightText($article->title, $search) !!}
                                @else
                                    {{ $article->title }}
                                @endif
                            </a>
                        </h3>

                        <!-- Excerpt -->
                        <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed">
                            @if($search)
                                {!! highlightText(Str::limit($article->excerpt ?? '', 150), $search) !!}
                            @else
                                {{ Str::limit($article->excerpt ?? '', 150) }}
                            @endif
                        </p>

                        <!-- Author and Read Time -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center gap-3">
                                @if($article->user->avatar)
                                    <img
                                            src="{{ $article->user->avatar }}"
                                            alt="{{ $article->user->name }}"
                                            class="w-8 h-8 rounded-full object-cover"
                                    >
                                @else
                                    <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-xs font-medium text-white">
                                        {{ substr($article->user->name, 0, 1) }}
                                    </div>
                                @endif
                                <span class="text-sm font-medium text-gray-700">{{ $article->user->name }}</span>
                            </div>
                            <span class="text-sm text-gray-500 bg-gray-50 px-2 py-1 rounded">
                                {{ $article->read_time ?? 5 }} min read
                            </span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($articles->hasPages())
            <div class="bg-white sidebar-card p-6 mt-8">
                {{ $articles->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="bg-white sidebar-card p-12 text-center">
            <div class="max-w-md mx-auto">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No articles found</h3>
                <p class="text-gray-600 mb-6">
                    @if($search || $selectedCategories || $selectedTags)
                        We couldn't find any articles matching your criteria. Try adjusting your search or filters.
                    @else
                        No articles have been published yet. Check back later for new content.
                    @endif
                </p>
                @if($search || $selectedCategories || $selectedTags)
                    <button
                            wire:click="clearFilters"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Clear All Filters
                    </button>
                @endif
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('searchUpdated', (data) => {
                @this.
                set('search', data.search);
            });
        });
    </script>
</div>