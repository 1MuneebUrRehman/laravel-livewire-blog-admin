<?php

namespace App\Livewire\Front\Articles;

use App\Models\Article;
use App\Models\Comment;
use Livewire\Component;

class ArticleComments extends Component
{
    public $article;
    public $commentText = '';
    public $comments;
    public $replyTo = null;
    public $replyText = '';

    public function mount(Article $article)
    {
        $this->article = $article;
        $this->loadComments();
    }

    public function loadComments()
    {
        $this->comments = $this->article->comments()
            ->with(['user', 'replies.user'])
            ->parentComments()
            ->approved()
            ->latest()
            ->get();
    }

    public function addComment()
    {
        $this->validate([
            'commentText' => 'required|min:3|max:1000'
        ]);

        Comment::create([
            'article_id' => $this->article->id,
            'user_id'    => auth()->id(),
            'content'    => $this->commentText,
            'status'     => 'approved', // or 'pending' if you want to moderate comments
        ]);

        $this->commentText = '';
        $this->loadComments();

        session()->flash('message', 'Comment added successfully!');
    }

    public function setReplyTo($commentId)
    {
        $this->replyTo   = $commentId;
        $this->replyText = '';
    }

    public function cancelReply()
    {
        $this->replyTo   = null;
        $this->replyText = '';
    }

    public function addReply()
    {
        $this->validate([
            'replyText' => 'required|min:3|max:500'
        ]);

        Comment::create([
            'article_id' => $this->article->id,
            'user_id'    => auth()->id(),
            'parent_id'  => $this->replyTo,
            'content'    => $this->replyText,
            'status'     => 'approved',
        ]);

        $this->replyTo   = null;
        $this->replyText = '';
        $this->loadComments();

        session()->flash('message', 'Reply added successfully!');
    }

    public function render()
    {
        return view('livewire.front.articles.article-comments');
    }
}