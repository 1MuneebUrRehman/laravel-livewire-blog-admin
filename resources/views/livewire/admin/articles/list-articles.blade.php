<div>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Articles</h1>
            <p class="mt-1 text-sm text-gray-600">Manage your blog articles</p>
        </div>
        <a href="{{ route('admin.articles.create') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
            New Article
        </a>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-md">
            {{ session('message') }}
        </div>
    @endif

    <!-- Search and Filters -->
    <div class="mb-6 bg-white rounded-lg shadow p-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex-1">
                <input
                        type="text"
                        wire:model.live="search"
                        placeholder="Search articles..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
            </div>
            <div class="flex items-center space-x-4">
                @if(count($selectedArticles) > 0)
                    <button
                            wire:click="bulkDelete"
                            wire:confirm="Are you sure you want to delete selected articles?"
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
                    >
                        Delete Selected ({{ count($selectedArticles) }})
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Articles Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="w-8 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <input
                                type="checkbox"
                                wire:model.live="selectAll"
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                        >
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <button type="button" wire:click="sortBy('title')" class="flex items-center space-x-1">
                            <span>Article</span>
                            @if($sortField === 'title')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}"/>
                                </svg>
                            @endif
                        </button>
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Category
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <button type="button" wire:click="sortBy('status')" class="flex items-center space-x-1">
                            <span>Status</span>
                            @if($sortField === 'status')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}"/>
                                </svg>
                            @endif
                        </button>
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <button type="button" wire:click="sortBy('created_at')" class="flex items-center space-x-1">
                            <span>Date</span>
                            @if($sortField === 'created_at')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}"/>
                                </svg>
                            @endif
                        </button>
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse($articles as $article)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input
                                    type="checkbox"
                                    wire:model.live="selectedArticles"
                                    value="{{ $article->id }}"
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                            >
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($article->featured_image)
                                    <img class="h-10 w-10 rounded-lg object-cover"
                                         src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}">
                                @else
                                    <div class="h-10 w-10 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ Str::limit($article->title, 50) }}</div>
                                    <div class="text-sm text-gray-500">by {{ $article->user->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $article->category->name }}
                                </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $article->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($article->status) }}
                                </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $article->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.articles.edit', $article) }}"
                               class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                            <button
                                    wire:click="deleteArticle({{ $article->id }})"
                                    wire:confirm="Are you sure you want to delete this article?"
                                    class="text-red-600 hover:text-red-900"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            No articles found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $articles->links() }}
        </div>
    </div>
</div>