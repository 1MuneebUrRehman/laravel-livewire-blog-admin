<section class="mb-12">
    <div class="flex items-center justify-between mb-8">
        <h3 class="text-3xl font-bold text-gray-900">Latest Articles</h3>
        <a href="{{ route('home') }}"
           class="text-indigo-600 font-medium hover:text-indigo-700 transition flex items-center">
            View All <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($articles as $article)
            <livewire:front.home.article-card :article="$article" :key="'article-'.$article->id"/>
        @endforeach
    </div>
</section>