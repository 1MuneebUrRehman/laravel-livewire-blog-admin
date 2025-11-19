<div class="bg-gray-50 min-h-screen">
    <!-- Page Header -->
    <div class="page-header-gradient text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between">
                <div>
                    <h1 class="text-4xl font-bold mb-2">All Articles</h1>
                    <p class="text-lg opacity-90 max-w-2xl">Browse our complete collection of business insights and
                        expert perspectives</p>
                </div>
                <div class="mt-6 md:mt-0">
                    <div class="flex items-center space-x-2 text-sm">
                        <span class="opacity-80" wire:loading.remove wire:target="search,category,sort,view">
                            Showing results...
                        </span>
                        <span wire:loading wire:target="search,category,sort,view" class="opacity-80">
                            Updating results...
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 -mt-6">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content Area -->
            <div class="lg:col-span-3">
                <livewire:front.articles.article-filters :categories="$categories"/>
                <livewire:front.articles.article-grid/>
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-1">
                <livewire:front.articles.article-sidebar
                        :categories="$categories"
                        :recentArticles="$recentArticles"
                        :popularTags="$popularTags"
                />
            </aside>
        </div>
    </div>
</div>

@script
<script>
    // Listen for category selection from the sidebar
    Livewire.on('category-selected', (data) => {
        // Find the ArticleFilters component and update its category
        @this.
        $wire.$parent.$wire.$set('category', data.category);
    });
</script>
@endscript