<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Create New Tag</h1>
        <p class="mt-1 text-sm text-gray-600">Add a new tag to categorize your articles</p>
    </div>

    <form wire:submit="save">
        <div class="max-w-2xl">
            <div class="bg-white rounded-lg shadow p-6">
                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Tag Name</label>
                    <input
                            type="text"
                            id="name"
                            wire:model="name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-300 @enderror"
                            placeholder="Enter tag name"
                    >
                    @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea
                            id="description"
                            wire:model="description"
                            rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Brief description of the tag (optional)"
                    ></textarea>
                </div>

                <!-- Actions -->
                <div class="flex justify-between">
                    <a
                            href="{{ route('admin.tags.index') }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        Cancel
                    </a>
                    <button
                            type="submit"
                            class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >
                        Create Tag
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>