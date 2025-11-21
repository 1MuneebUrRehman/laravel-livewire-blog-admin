<div>
    <!-- Search Component -->
    <div class="mb-8">
        <div class="relative group">
            <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl blur opacity-25 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
            <div class="relative">
                <input
                        type="text"
                        wire:model.live="search"
                        placeholder="Search articles..."
                        class="w-full px-6 py-4 rounded-2xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white shadow-sm text-lg"
                >
                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                    <i class="fas fa-search"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Filters -->
    @if(count($selectedCategories) > 0 || count($selectedTags) > 0)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-semibold text-gray-900">Active Filters</h4>
                <span class="text-sm text-gray-500">{{ count($selectedCategories) + count($selectedTags) }} active</span>
            </div>
            <div class="flex flex-wrap gap-2">
                @foreach($selectedCategories as $categorySlug)
                    @php
                        $category = $categories->firstWhere('slug', $categorySlug);
                    @endphp
                    @if($category)
                        <span class="inline-flex items-center gap-2 px-3 py-2 bg-indigo-50 text-indigo-700 rounded-full text-sm font-medium border border-indigo-200">
                            <i class="fas fa-folder text-indigo-500"></i>
                            {{ $category->name }}
                            <button
                                    wire:click="removeCategory('{{ $categorySlug }}')"
                                    class="hover:text-indigo-900 transition-colors"
                            >
                                <i class="fas fa-times"></i>
                            </button>
                        </span>
                    @endif
                @endforeach

                @foreach($selectedTags as $tagSlug)
                    @php
                        $tag = $popularTags->firstWhere('slug', $tagSlug);
                    @endphp
                    @if($tag)
                        <span class="inline-flex items-center gap-2 px-3 py-2 bg-blue-50 text-blue-700 rounded-full text-sm font-medium border border-blue-200">
                            <i class="fas fa-tag text-blue-500"></i>
                            {{ $tag->name }}
                            <button
                                    wire:click="removeTag('{{ $tagSlug }}')"
                                    class="hover:text-blue-900 transition-colors"
                            >
                                <i class="fas fa-times"></i>
                            </button>
                        </span>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    <!-- Filters and Results Header -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <!-- Left Side: Filters -->
            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                <!-- Sort Dropdown -->
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg blur opacity-25 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                    <select
                            wire:model.live="sortBy"
                            class="relative w-full sm:w-48 px-4 py-3 pr-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white cursor-pointer shadow-sm"
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
                @if($search || count($selectedCategories) > 0 || count($selectedTags) > 0)
                    <button
                            wire:click="clearFilters"
                            class="relative flex items-center gap-2 px-4 py-3 text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors group"
                    >
                        <div class="absolute inset-0 bg-indigo-50 rounded-lg group-hover:bg-indigo-100 transition-colors"></div>
                        <span class="relative flex items-center gap-2">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Clear All Filters
                        </span>
                    </button>
                @endif
            </div>

            <!-- Right Side: Results Count -->
            <div class="text-sm text-gray-600 bg-gradient-to-r from-gray-50 to-gray-100 px-4 py-2 rounded-lg border border-gray-200">
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
                        class="group relative bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <!-- Premium Badge -->
                    @if($article->is_premium)
                        <div class="absolute top-4 right-4 z-10">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-amber-400 to-amber-500 text-white shadow-lg">
                                <i class="fas fa-crown mr-1"></i>
                                PREMIUM
                            </span>
                        </div>
                    @endif

                    <!-- Image Container -->
                    @if($article->featured_image)
                        <div class="relative overflow-hidden h-56">
                            <img
                                    src="{{ $article->featured_image }}"
                                    alt="{{ $article->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    @else
                        <div class="relative h-56 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center group-hover:from-gray-200 group-hover:to-gray-300 transition-all duration-500 overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-purple-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <svg class="w-16 h-16 text-gray-400 group-hover:text-indigo-400 transition-colors duration-500 relative z-10"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif

                    <!-- Content -->
                    <div class="p-6 relative">
                        <!-- Category and Date -->
                        <div class="flex items-center justify-between mb-4">
                            @if($article->category)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-indigo-50 to-blue-50 text-indigo-700 border border-indigo-100">
                                    <i class="fas fa-folder mr-1 text-indigo-500"></i>
                                    {{ $article->category->name }}
                                </span>
                            @endif
                            <span class="text-sm text-gray-500 flex items-center">
                                <i class="far fa-clock mr-1"></i>
                                @if($article->published_at)
                                    {{ $article->published_at->format('M j, Y') }}
                                @else
                                    <span class="text-amber-600">Draft</span>
                                @endif
                            </span>
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-indigo-600 transition-colors duration-300 line-clamp-2 leading-tight">
                            <a href="{{ route('articles.show', $article->slug) }}" class="hover:no-underline relative">
                                @if($search)
                                    {!! highlightText($article->title, $search) !!}
                                @else
                                    {{ $article->title }}
                                @endif
                            </a>
                        </h3>

                        <!-- Excerpt -->
                        <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed text-sm">
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
                                            class="w-9 h-9 rounded-full object-cover border-2 border-white shadow-sm"
                                    >
                                @else
                                    <div class="w-9 h-9 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-sm font-bold text-white shadow-sm">
                                        {{ substr($article->user->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <span class="text-sm font-semibold text-gray-900 block">{{ $article->user->name }}</span>
                                    <span class="text-xs text-gray-500">Author</span>
                                </div>
                            </div>
                            <span class="text-xs text-gray-500 bg-gray-50 px-3 py-1.5 rounded-full border border-gray-200 flex items-center gap-1">
                                <i class="far fa-clock text-gray-400"></i>
                                {{ $article->read_time ?? 5 }} min read
                            </span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($articles->hasPages())
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mt-8">
                {{ $articles->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-16 text-center">
            <div class="max-w-md mx-auto">
                <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">No articles found</h3>
                <p class="text-gray-600 mb-8 text-lg">
                    @if($search || count($selectedCategories) > 0 || count($selectedTags) > 0)
                        We couldn't find any articles matching your criteria. Try adjusting your search or filters.
                    @else
                        No articles have been published yet. Check back later for new content.
                    @endif
                </p>
                @if($search || count($selectedCategories) > 0 || count($selectedTags) > 0)
                    <button
                            wire:click="clearFilters"
                            class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-300 transform hover:-translate-y-1 shadow-lg hover:shadow-xl"
                    >
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Clear All Filters
                    </button>
                @endif
            </div>
        </div>
    @endif
</div>
