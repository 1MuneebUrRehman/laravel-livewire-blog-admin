<section class="mb-12">
    <h3 class="text-3xl font-bold text-gray-900 mb-8">Browse by Category</h3>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @foreach($categories as $category)
            @php
                $staticColors = [
                    'technology' => 'text-indigo-600',
                    'marketing' => 'text-blue-600',
                    'finance' => 'text-green-600',
                    'leadership' => 'text-yellow-600',
                    'innovation' => 'text-red-600',
                    'business' => 'text-purple-600',
                ];
                $textColor = $staticColors[$category->slug] ?? 'text-indigo-600';
            @endphp

            <a href="{{ route('home') }}"
               class="category-card bg-white rounded-xl shadow-md p-6 hover:shadow-xl transition text-center group hover:-translate-y-1">
                <div class="{{ $textColor }} mb-3 category-icon">
                    <i class="{{ $category->icon }} text-3xl"></i>
                </div>
                <h4 class="font-bold text-gray-900">{{ $category->name }}</h4>
                <p class="text-sm text-gray-500 mt-1">{{ $category->articles_count }} articles</p>
            </a>
        @endforeach
    </div>
</section>