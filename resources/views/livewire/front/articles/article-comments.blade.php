<section class="mt-12 bg-white rounded-xl shadow-sm p-8">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Comments ({{ $comments->count() }})</h2>

    <!-- Comment Form -->
    @auth
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Leave a comment</h3>
            <form wire:submit.prevent="addComment">
                <div class="mb-4">
                <textarea
                        wire:model="commentText"
                        rows="4"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent"
                        placeholder="Share your thoughts..."
                        required
                ></textarea>
                    @error('commentText') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end">
                    <button
                            type="submit"
                            class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-indigo-700 transition"
                    >
                        Post Comment
                    </button>
                </div>
            </form>
        </div>
    @else
        <div class="mb-8 p-4 bg-blue-50 rounded-lg">
            <p class="text-blue-800">
                Please <a href="{{ route('home') }}" class="font-semibold underline">login</a> to leave a comment.
            </p>
        </div>
    @endauth

    <!-- Reply Form -->
    @if($replyTo)
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <h4 class="font-semibold text-gray-900 mb-3">Replying to comment</h4>
            <form wire:submit.prevent="addReply">
                <div class="mb-3">
                <textarea
                        wire:model="replyText"
                        rows="3"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent"
                        placeholder="Write your reply..."
                        required
                ></textarea>
                    @error('replyText') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end space-x-3">
                    <button
                            type="button"
                            wire:click="cancelReply"
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition"
                    >
                        Cancel
                    </button>
                    <button
                            type="submit"
                            class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-indigo-700 transition"
                    >
                        Post Reply
                    </button>
                </div>
            </form>
        </div>
    @endif

    <!-- Comments List -->
    <div class="space-y-6">
        @foreach($comments as $comment)
            <div class="comment-card bg-gray-50 rounded-xl p-6">
                <div class="flex items-start space-x-4">
                    <img src="{{ $comment->user->avatar }}" alt="User" class="w-10 h-10 rounded-full">
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="font-semibold text-gray-900">{{ $comment->user->name }}</h4>
                            <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-700 mb-3">{{ $comment->content }}</p>
                        <div class="flex items-center space-x-4 text-sm">
                            @auth
                                <button
                                        wire:click="setReplyTo({{ $comment->id }})"
                                        class="text-gray-600 hover:text-indigo-600 transition"
                                >
                                    Reply
                                </button>
                            @endauth
                        </div>

                        <!-- Replies -->
                        @if($comment->replies->count() > 0)
                            <div class="mt-6 space-y-4 ml-6 pl-6 border-l-2 border-gray-200">
                                @foreach($comment->replies as $reply)
                                    <div class="bg-white rounded-lg p-4">
                                        <div class="flex items-start space-x-3">
                                            <img src="{{ $reply->user->avatar }}" alt="User"
                                                 class="w-8 h-8 rounded-full">
                                            <div class="flex-1">
                                                <div class="flex items-center justify-between mb-1">
                                                    <h5 class="font-medium text-gray-900">{{ $reply->user->name }}</h5>
                                                    <span class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                                </div>
                                                <p class="text-gray-700 text-sm">{{ $reply->content }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        @if($comments->isEmpty())
            <div class="text-center py-8 text-gray-500">
                <i class="far fa-comments text-4xl mb-4"></i>
                <p>No comments yet. Be the first to share your thoughts!</p>
            </div>
        @endif
    </div>

    <!-- Success Message -->
    @if(session()->has('message'))
        <div class="mt-4 p-4 bg-green-50 text-green-700 rounded-lg">
            {{ session('message') }}
        </div>
    @endif
</section>