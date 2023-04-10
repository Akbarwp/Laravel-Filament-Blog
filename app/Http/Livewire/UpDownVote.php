<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\UpDownVote as ModelsUpDownVote;
use Livewire\Component;

class UpDownVote extends Component
{
    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        $upVotes = ModelsUpDownVote::where('post_id', '=', $this->post->id)->where('is_upvote', '=', true)->count();
        $downVotes = ModelsUpDownVote::where('post_id', '=', $this->post->id)->where('is_upvote', '=', false)->count();

        $hasUpVote = null;

        $user = request()->user();
        if ($user) {
            $model = ModelsUpDownVote::where('post_id', '=', $this->post->id)->where('user_id', '=', $user->id)->first();

            if ($model) {
                $hasUpVote = !!$model->is_upvote;
            }
        }

        return view('livewire.up-down-vote', [
            'upVotes' => $upVotes,
            'downVotes' => $downVotes,
            'hasUpVote' => $hasUpVote
        ]);
    }

    public function updownVote($upVotes = true)
    {
        $user = request()->user();
        if (!$user) {
            return $this->redirect('login');
        }
        if (!$user->hasVerifiedEmail()) {
            return $this->redirect(route('verification.notice'));
        }

        $model = ModelsUpDownVote::where('post_id', '=', $this->post->id)->where('user_id', '=', $user->id)->first();

        if (!$model) {
            ModelsUpDownVote::create([
                'is_upvote' => $upVotes,
                'post_id' => $this->post->id,
                'user_id' => $user->id,
            ]);
            return;
        }

        if ($upVotes && $model->is_upvote || !$upVotes && !$model->is_upvote) {
            $model->delete();

        } else {
            $model->is_upvote = $upVotes;
            $model->save();
        }
    }
}
