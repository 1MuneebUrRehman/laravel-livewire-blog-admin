<section class="mb-12">
    <h3 class="text-3xl font-bold text-gray-900 mb-8">Browse by Category</h3>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @foreach($categories as $category)
            <a href="{{ route('home') }}"
               class="category-card bg-white rounded-xl shadow-md p-6 hover:shadow-xl transition text-center">
                <div class="text-indigo-600 mb-3 category-icon">
                    <i class="fas {{ $category->icon ?? 'fa-folder' }} text-3xl"></i>
                </div>
                <h4 class="font-bold text-gray-900">{{ $category->name }}</h4>
                <p class="text-sm text-gray-500 mt-1">{{ $category->articles_count }} articles</p>
            </a>
        @endforeach
    </div>
</section>