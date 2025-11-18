<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Article</h1>
        <p class="mt-1 text-sm text-gray-600">Update your article details</p>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-md">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit="update">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Title -->
                <div class="bg-white rounded-lg shadow p-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                    <input
                            type="text"
                            id="title"
                            wire:model="title"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-300 @enderror"
                            placeholder="Enter article title"
                    >
                    @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div class="bg-white rounded-lg shadow p-6">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                    <textarea
                            id="content"
                            wire:model="content"
                            rows="15"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('content') border-red-300 @enderror"
                            placeholder="Write your article content here..."
                    ></textarea>
                    @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Excerpt -->
                <div class="bg-white rounded-lg shadow p-6">
                    <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
                    <textarea
                            id="excerpt"
                            wire:model="excerpt"
                            rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Brief description of the article (optional)"
                    ></textarea>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Publish Settings -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Publish Settings</h3>

                    <!-- Status -->
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select
                                id="status"
                                wire:model="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>

                    <!-- Category -->
                    <div class="mb-4">
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select
                                id="category_id"
                                wire:model="category_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('category_id') border-red-300 @enderror"
                        >
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tags -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                        <div class="space-y-2 max-h-48 overflow-y-auto">
                            @foreach($allTags as $tag)
                                <label class="flex items-center">
                                    <input
                                            type="checkbox"
                                            wire:model="tags"
                                            value="{{ $tag->id }}"
                                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                    >
                                    <span class="ml-2 text-sm text-gray-700">{{ $tag->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Featured Image</h3>

                    @if($featured_image)
                        <div class="mb-4">
                            <img src="{{ Storage::url($featured_image) }}" alt="Current featured image"
                                 class="w-full h-48 object-cover rounded-lg">
                        </div>
                    @endif

                    @if($new_featured_image)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">New image preview:</p>
                            <img src="{{ $new_featured_image->temporaryUrl() }}" alt="New featured image preview"
                                 class="w-full h-48 object-cover rounded-lg">
                        </div>
                    @endif

                    <input
                            type="file"
                            wire:model="new_featured_image"
                            accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                    >
                    @error('new_featured_image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- SEO Settings -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">SEO Settings</h3>

                    <!-- Meta Title -->
                    <div class="mb-4">
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                        <input
                                type="text"
                                id="meta_title"
                                wire:model="meta_title"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="SEO title (optional)"
                        >
                    </div>

                    <!-- Meta Description -->
                    <div>
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta
                            Description</label>
                        <textarea
                                id="meta_description"
                                wire:model="meta_description"
                                rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="SEO description (optional)"
                        ></textarea>
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between">
                        <a
                                href="{{ route('admin.articles.index') }}"
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            Cancel
                        </a>
                        <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        >
                            Update Article
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>