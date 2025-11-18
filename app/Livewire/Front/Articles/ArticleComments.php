<?php

namespace App\Http\Livewire\Front\Articles;

use App\Models\Article;
use App\Models\Comment;
use Livewire\Component;

class ArticleComments extends Component
{
    public $article;
    public $comments;
    public $newComment = '';
    public $replyTo = null;
    public $replyContent = '';

    protected $rules = [
        'newComment'   => 'required|string|min:3|max:1000',
        'replyContent' => 'required|string|min:3|max:1000',
    ];

    public function mount(Article $article)
    {
        $this->article = $article;
        $this->loadComments();
    }

    public function loadComments()
    {
        $this->comments = $this->article->comments()
            ->with('user', 'replies.user')
            ->whereNull('parent_id')
            ->latest()
            ->get();
    }

    public function addComment()
    {
        $this->validateOnly('newComment');

        Comment::create([
            'content'    => $this->newComment,
            'article_id' => $this->article->id,
            'user_id'    => auth()->id(),
        ]);

        $this->newComment = '';
        $this->loadComments();

        session()->flash('message', 'Comment added successfully.');
    }

    public function startReply($commentId)
    {
        $this->replyTo      = $commentId;
        $this->replyContent = '';
    }

    public function cancelReply()
    {
        $this->replyTo      = null;
        $this->replyContent = '';
    }

    public function addReply()
    {
        $this->validateOnly('replyContent');

        Comment::create([
            'content'    => $this->replyContent,
            'article_id' => $this->article->id,
            'user_id'    => auth()->id(),
            'parent_id'  => $this->replyTo,
        ]);

        $this->cancelReply();
        $this->loadComments();

        session()->flash('message', 'Reply added successfully.');
    }

    public function render()
    {
        return view('livewire.front.articles.article-comments');
    }
}