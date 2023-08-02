<div>
    <h1 class="text-xl font-bold mb-3" id="comments_title">Comments</h1>
    <livewire:comment-create :post="$post" />
    <div class="mb-10 mt-3">
        @foreach ($comments as $comment)
            <livewire:comment-item :comment="$comment" wire:key="comment-{{ $comment->id }}-{{ $comment->comments->count() }}">
        @endforeach
        {{ $comments->links() }}
    </div>
</div>
