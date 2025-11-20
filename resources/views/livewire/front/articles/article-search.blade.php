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

                    @if($search)
                        <button
                                wire:click="$set('search', '')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center"
                        >
                            <i class="fas fa-times text-gray-400 hover:text-gray-600"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>