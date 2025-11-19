<div>
    <!-- Search and Filter Bar -->
    <div class="bg-white sidebar-card p-6 mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <!-- Search Input -->
            <div class="flex-1">
                <div class="relative">
                    <input
                            type="text"
                            wire:model.live="search"
                            placeholder="Search articles..."
                            class="w-full px-4 py-3 pl-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent"
                    >
                    <i class="fas fa-search text-gray-400 absolute left-3 top-3.5"></i>
                </div>
            </div>

            <!-- View Toggle -->
            <div class="flex items-center space-x-2">
                <span class="text-gray-600 text-sm hidden sm:block">View:</span>
                <button
                        wire:click="$set('view', 'grid')"
                        class="p-2 rounded-md {{ $view === 'grid' ? 'bg-indigo-100 text-indigo-700' : 'text-gray-500 hover:bg-gray-100' }}"
                >
                    <i class="fas fa-th"></i>
                </button>
                <button
                        wire:click="$set('view', 'list')"
                        class="p-2 rounded-md {{ $view === 'list' ? 'bg-indigo-100 text-indigo-700' : 'text-gray-500 hover:bg-gray-100' }}"
                >
                    <i class="fas fa-list"></i>
                </button>
            </div>

            <!-- Sort Dropdown -->
            <div class="relative">
                <select
                        wire:model.live="sort"
                        class="appearance-none w-full md:w-auto px-4 py-3 pr-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent bg-white"
                >
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                    <option value="popular">Most Popular</option>
                    <option value="title">Title A-Z</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
        </div>

        <!-- Filter Options -->
        <div class="mt-6 pt-6 border-t border-gray-200">
            <div class="flex flex-wrap gap-2">
                <button
                        wire:click="$set('category', '')"
                        class="px-4 py-2 rounded-full text-sm font-medium transition {{ !$category ? 'active-filter' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                >
                    All Articles
                </button>
                @foreach($categories as $cat)
                    <button
                            wire:click="$set('category', '{{ $cat->slug }}')"
                            class="px-4 py-2 rounded-full text-sm font-medium transition {{ $category === $cat->slug ? 'active-filter' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                    >
                        {{ $cat->name }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>
</div>