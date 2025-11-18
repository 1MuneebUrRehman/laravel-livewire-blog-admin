<div class="bg-gradient-to-br from-indigo-600 to-purple-600 sidebar-card p-6 mb-8 text-white">
    <div class="flex items-center mb-4">
        <i class="fas fa-envelope-open-text text-2xl mr-3"></i>
        <h3 class="text-xl font-bold">Stay Updated</h3>
    </div>
    <p class="text-sm opacity-90 mb-4">Get the latest insights delivered to your inbox weekly.</p>
    <form wire:submit.prevent="subscribe" class="space-y-3">
        @if(session('message'))
            <div class="bg-green-500 text-white p-3 rounded-lg text-sm">
                {{ session('message') }}
            </div>
        @endif
        <input type="email" wire:model="email" placeholder="Enter your email" required
               class="w-full px-4 py-3 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-300">
        @error('email') <span class="text-red-300 text-sm">{{ $message }}</span> @enderror
        <button type="submit"
                class="w-full bg-white text-indigo-600 font-semibold py-3 rounded-lg hover:bg-gray-100 transition flex items-center justify-center">
            <i class="fas fa-paper-plane mr-2"></i> Subscribe
        </button>
    </form>
</div>