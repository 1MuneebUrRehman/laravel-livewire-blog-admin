<div class="bg-white sidebar-card p-6">
    <div class="flex items-center mb-4">
        <i class="fas fa-tags text-indigo-600 text-xl mr-3"></i>
        <h3 class="text-xl font-bold text-gray-900">Popular Tags</h3>
    </div>
    <div class="tag-cloud flex flex-wrap gap-2">
        @foreach($tags as $tag)
            <a href="{{ route('home') }}"
               class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm cursor-pointer hover:bg-indigo-600 hover:text-white transition">
                {{ $tag->name }}
            </a>
        @endforeach
    </div>
</div>