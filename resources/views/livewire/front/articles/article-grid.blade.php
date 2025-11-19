<div>
    <!-- Articles Grid/List -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($articles as $article)
            <livewire:front.articles.article-card
                    :article="$article"
                    :key="'article-' . $article->id"
            />
        @empty
            <div class="col-span-full text-center py-12">
                <i class="fas fa-search text-4xl text-gray-400 mb-4"></i>
                <h3 class="mt-4 text-xl font-medium text-gray-900">No articles found</h3>
                <p class="mt-2 text-gray-500">Try adjusting your search or filter criteria.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($articles->hasPages())
        <div class="mt-12">
            {{ $articles->links('vendor.pagination.tailwind') }}
        </div>
    @endif
</div>