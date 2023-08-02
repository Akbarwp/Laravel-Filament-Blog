<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class Comments extends Component
{
    public Post $post;

    protected $listeners = [
        'commentCreated' => '$refresh',
        'commentDeleted' => '$refresh',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
    }
    
    public function render()
    {
        $comments = $this->selectComments();
        return view('livewire.comments', compact('comments'));
    }

    public function selectComments()
    {
        return Comment::query()
            ->with(['post', 'user', 'comments'])
            ->whereNull('parent_id')
            ->where('post_id', '=', $this->post->id)
            ->orderBy('comments.created_at', 'desc')
            ->paginate(10);
    }
}
