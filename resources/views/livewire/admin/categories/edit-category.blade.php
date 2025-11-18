<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Category</h1>
        <p class="mt-1 text-sm text-gray-600">Update category details</p>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-md">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit="update">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Form -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <!-- Name -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
                        <input
                                type="text"
                                id="name"
                                wire:model="name"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-300 @enderror"
                                placeholder="Enter category name"
                        >
                        @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description"
                               class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea
                                id="description"
                                wire:model="description"
                                rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Brief description of the category (optional)"
                        ></textarea>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
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
                                href="{{ route('admin.categories.index') }}"
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            Cancel
                        </a>
                        <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        >
                            Update Category
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>