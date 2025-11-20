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
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 -mt-6">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content Area -->
            <div class="lg:col-span-3">
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