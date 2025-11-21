<div class="bg-gray-50 min-h-screen">
    <!-- Page Header - Fixed to match Single Article -->
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
                            <li><a href="{{ route('categories') }}" class="hover:text-white transition">Categories</a>
                            </li>
                            <li><i class="fas fa-chevron-right text-xs"></i></li>
                            <li class="text-white">{{ $category->name }}</li>
                        </ol>
                    </nav>
                    <h1 class="text-4xl font-bold mb-2">{{ $category->name }}</h1>
                    <p class="text-lg opacity-90 max-w-2xl">{{ $category->description ?? 'Explore articles in this category' }}</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <div class="inline-flex items-center bg-white/20 px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm">
                        <i class="fas fa-newspaper mr-2"></i>
                        {{ $category->articles_count }} {{ Str::plural('Article', $category->articles_count) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content Area -->
            <div class="lg:col-span-3">
                <!-- Search and Filter Bar -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <input
                                        type="text"
                                        wire:model.live="search"
                                        placeholder="Search articles in {{ $category->name }}..."
                                        class="w-full px-4 py-3 pl-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors duration-200"
                                >
                                <i class="fas fa-search text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-600 text-sm font-medium hidden sm:block">View:</span>
                            <div class="flex bg-gray-100 rounded-lg p-1">
                                <button
                                        type="button"
                                        wire:click="setViewMode('grid')"
                                        class="px-4 py-2 rounded-md text-sm font-medium transition-all duration-200 {{ $viewMode === 'grid' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}"
                                >
                                    <i class="fas fa-th-large mr-2"></i>Grid
                                </button>
                                <button
                                        type="button"
                                        wire:click="setViewMode('list')"
                                        class="px-4 py-2 rounded-md text-sm font-medium transition-all duration-200 {{ $viewMode === 'list' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}"
                                >
                                    <i class="fas fa-list mr-2"></i>List
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Articles Grid -->
                @if($articles->count() > 0)
                    @if($viewMode === 'grid')
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                            @foreach($articles as $article)
                                <article
                                        class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-all duration-300 group">
                                    <!-- Article Image -->
                                    <div class="relative overflow-hidden">
                                        <img
                                                src="{{ $article->featured_image ?? 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=400&h=250&fit=crop' }}"
                                                alt="{{ $article->title }}"
                                                class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
                                        >
                                        <div class="absolute top-4 left-4">
                                            <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-semibold">
                                                {{ $article->category->name }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="p-6">
                                        <!-- Article Meta -->
                                        <div class="flex items-center justify-between mb-3 text-sm text-gray-500">
                                            <span class="flex items-center">
                                                <i class="far fa-calendar mr-1.5"></i>
                                                {{ $article->published_at?->format('M j, Y') ?? 'Draft' }}
                                            </span>
                                            <span class="flex items-center">
                                                <i class="far fa-clock mr-1.5"></i>
                                                {{ $article->reading_time }} min read
                                            </span>
                                        </div>

                                        <!-- Article Title -->
                                        <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-indigo-600 transition-colors duration-200">
                                            <a href="{{ route('articles.show', $article->slug) }}"
                                               class="hover:no-underline">
                                                {{ $article->title }}
                                            </a>
                                        </h3>

                                        <!-- Article Excerpt -->
                                        <p class="text-gray-600 mb-4 text-sm leading-relaxed line-clamp-3">
                                            {{ Str::limit($article->excerpt, 120) }}
                                        </p>

                                        <!-- Article Footer -->
                                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                            <div class="flex items-center space-x-3">
                                                <img
                                                        src="{{ $article->user->avatar }}"
                                                        alt="{{ $article->user->name }}"
                                                        class="w-8 h-8 rounded-full object-cover"
                                                >
                                                <span class="text-sm font-medium text-gray-700">{{ $article->user->name }}</span>
                                            </div>
                                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                                <span class="flex items-center space-x-1">
                                                    <i class="far fa-heart"></i>
                                                    <span>{{ $article->likes_count }}</span>
                                                </span>
                                                <span class="flex items-center space-x-1">
                                                    <i class="far fa-comment"></i>
                                                    <span>{{ $article->comments_count }}</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <!-- List View -->
                        <div class="space-y-6">
                            @foreach($articles as $article)
                                <article
                                        class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-all duration-300 group">
                                    <div class="flex flex-col md:flex-row md:items-start gap-6">
                                        <!-- Article Image -->
                                        <div class="md:w-48 flex-shrink-0">
                                            <img
                                                    src="{{ $article->featured_image ?? 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=300&h=200&fit=crop' }}"
                                                    alt="{{ $article->title }}"
                                                    class="w-full h-32 object-cover rounded-lg"
                                            >
                                        </div>

                                        <!-- Article Content -->
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-4 mb-3">
                                                <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-semibold">
                                                    {{ $article->category->name }}
                                                </span>
                                                <span class="text-gray-500 text-sm">
                                                    {{ $article->published_at?->format('M j, Y') ?? 'Draft' }}
                                                </span>
                                                <span class="text-gray-500 text-sm flex items-center">
                                                    <i class="far fa-clock mr-1"></i>
                                                    {{ $article->reading_time }} min
                                                </span>
                                            </div>

                                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors duration-200">
                                                <a href="{{ route('articles.show', $article->slug) }}"
                                                   class="hover:no-underline">
                                                    {{ $article->title }}
                                                </a>
                                            </h3>

                                            <p class="text-gray-600 mb-4 text-sm leading-relaxed">
                                                {{ Str::limit($article->excerpt, 160) }}
                                            </p>

                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-3">
                                                    <img
                                                            src="{{ $article->user->avatar }}"
                                                            alt="{{ $article->user->name }}"
                                                            class="w-6 h-6 rounded-full object-cover"
                                                    >
                                                    <span class="text-sm text-gray-600">{{ $article->user->name }}</span>
                                                </div>
                                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                                    <span class="flex items-center space-x-1">
                                                        <i class="far fa-heart"></i>
                                                        <span>{{ $article->likes_count }}</span>
                                                    </span>
                                                    <span class="flex items-center space-x-1">
                                                        <i class="far fa-eye mr-1"></i>
                                                        <span>{{ $article->views }}</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif

                    <!-- Pagination -->
                    @if($articles->hasPages())
                        <div class="mt-12">
                            {{ $articles->links('vendor.pagination.tailwind') }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16 bg-white rounded-xl shadow-sm">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                            <i class="fas fa-newspaper text-3xl text-gray-400"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">No articles found</h3>
                        <p class="text-gray-600 text-lg mb-6">Try adjusting your search criteria or browse all
                            categories</p>
                        <a href="{{ route('articles') }}"
                           class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to All Articles
                        </a>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-1">
                <div class="sticky-sidebar space-y-8">
                    <!-- Category Info -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center mr-3 shadow-sm">
                                <i class="fas fa-info-circle text-white text-sm"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Category Info</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-600">Total Articles</span>
                                <span class="font-semibold text-gray-900">{{ $category->articles_count }}</span>
                            </div>
                            @if($category->created_at)
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Created</span>
                                    <span class="text-sm text-gray-500">{{ $category->created_at->format('M Y') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Related Categories -->
                    @if($relatedCategories->count() > 0)
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center mr-3 shadow-sm">
                                    <i class="fas fa-folder text-white text-sm"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Related Categories</h3>
                            </div>
                            <div class="space-y-3">
                                @foreach($relatedCategories as $relatedCategory)
                                    <a href="{{ route('category.show', $relatedCategory->slug) }}"
                                       class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200 group">
                                        <div class="w-10 h-10 bg-indigo-50 rounded-lg flex items-center justify-center group-hover:bg-indigo-100 transition-colors duration-200">
                                            <i class="fas {{ $relatedCategory->icon ?? 'fa-folder' }} text-indigo-600 text-sm"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors duration-200 truncate text-sm">
                                                {{ $relatedCategory->name }}
                                            </h4>
                                            <p class="text-xs text-gray-500">{{ $relatedCategory->articles_count }}
                                                articles</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Popular Tags -->
                    @if($popularTags->count() > 0)
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center mr-3 shadow-sm">
                                    <i class="fas fa-tags text-white text-sm"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Popular Tags</h3>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                @foreach($popularTags as $tag)
                                    <a href="{{ route('articles', ['tag' => $tag->slug]) }}"
                                       class="bg-gray-100 text-gray-700 px-3 py-1.5 rounded-full text-sm hover:bg-indigo-600 hover:text-white transition-all duration-200 hover:-translate-y-0.5">
                                        #{{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </aside>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .page-header-gradient {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #2563eb 100%);
        }

        .sticky-sidebar {
            position: sticky;
            top: 2rem;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Smooth transitions */
        .transition-all {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
@endpush