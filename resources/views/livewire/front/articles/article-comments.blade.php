<div>
    <div class="bg-white rounded-lg shadow-sm border p-6">
        <h3 class="text-xl font-bold text-gray-900 mb-6">
            Comments ({{ $comments->count() }})
        </h3>

        @if (session()->has('message'))
            <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-md">
                {{ session('message') }}
            </div>
        @endif

        <!-- Add Comment Form -->
        @auth
            <div class="mb-8">
                <form wire:submit="addComment">
                    <label for="newComment" class="block text-sm font-medium text-gray-700 mb-2">
                        Add a comment
                    </label>
                    <textarea
                            id="newComment"
                            wire:model="newComment"
                            rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('newComment') border-red-300 @enderror"
                            placeholder="Share your thoughts..."
                    ></textarea>
                    @error('newComment')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <div class="mt-3">
                        <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300"
                        >
                            Post Comment
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="mb-8 p-4 bg-gray-50 rounded-lg text-center">
                <p class="text-gray-600 mb-2">Please log in to leave a comment.</p>
                <a
                        href="{{ route('login') }}"
                        class="text-blue-600 hover:text-blue-800 font-medium"
                >
                    Log in
                </a>
            </div>
        @endauth

        <!-- Comments List -->
        <div class="space-y-6">
            @forelse($comments as $comment)
                <div class="border-b border-gray-200 pb-6 last:border-0">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-blue-600 text-sm font-bold">{{ substr($comment->user->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">{{ $comment->user->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>

                    <p class="text-gray-700 mb-3">{{ $comment->content }}</p>

                    @auth
                        <button
                                wire:click="startReply({{ $comment->id }})"
                                class="text-sm text-blue-600 hover:text-blue-800 font-medium"
                        >
                            Reply
                        </button>
                    @endauth

                    <!-- Reply Form -->
                    @if($replyTo === $comment->id)
                        <div class="mt-4 ml-8 p-4 bg-gray-50 rounded-lg">
                            <form wire:submit="addReply">
                                <label for="replyContent" class="block text-sm font-medium text-gray-700 mb-2">
                                    Reply to {{ $comment->user->name }}
                                </label>
                                <textarea
                                        id="replyContent"
                                        wire:model="replyContent"
                                        rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('replyContent') border-red-300 @enderror"
                                        placeholder="Write your reply..."
                                ></textarea>
                                @error('replyContent')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <div class="mt-3 flex space-x-3">
                                    <button
                                            type="submit"
                                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300"
                                    >
                                        Post Reply
                                    </button>
                                    <button
                                            type="button"
                                            wire:click="cancelReply"
                                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300"
                                    >
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif

                    <!-- Replies -->
                    @if($comment->replies->count() > 0)
                        <div class="mt-4 ml-8 space-y-4">
                            @foreach($comment->replies as $reply)
                                <div class="border-l-2 border-gray-200 pl-4">
                                    <div class="flex items-start justify-between mb-2">
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-2">
                                                <span class="text-green-600 text-xs font-bold">{{ substr($reply->user->name, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <h5 class="font-medium text-gray-900 text-sm">{{ $reply->user->name }}</h5>
                                                <p class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-700">{{ $reply->content }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <div class="text-center py-8">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <p class="text-gray-500">No comments yet. Be the first to share your thoughts!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>