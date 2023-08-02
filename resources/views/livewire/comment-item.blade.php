<div>
    <div class="mb-3 block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]">
        <div class="border-b-2 border-neutral-100 px-6 py-3">
            <div class="flex items-center">
                <div class="p-2 bg-slate-100 rounded-full">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M4 22C4 17.5817 7.58172 14 12 14C16.4183 14 20 17.5817 20 22H18C18 18.6863 15.3137 16 12 16C8.68629 16 6 18.6863 6 22H4ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11Z"></path></svg>
                </div>
                <div class="ml-2"><span class="text-blue-700 font-semibold">{{ $comment->user->name }}</span> <span class="text-gray-500">∘ {{ $comment->created_at->diffForHumans() }}</span></div>
            </div>
        </div>
        <div class="p-6">
            @if ($editing)
                <livewire:comment-create :comment-model="$comment" />
            @else
                <p class="mb-4 text-base text-neutral-700">
                    {{ $comment->comment }}
                </p>
            @endif
            <div class="mt-2 mb-3">
                <button wire:click.prevent="startReply" class="mr-2 inline-flex items-center font-semibold text-xs text-blue-700 uppercase tracking-widest hover:underline transition ease-in-out duration-150">Reply</button>
                @if ($comment->user_id == auth()->user()->id)
                    <button wire:click.prevent="startCommentEdit" class="mr-2 inline-flex items-center font-semibold text-xs text-yellow-500 uppercase tracking-widest hover:underline transition ease-in-out duration-150">Edit</button>
                    <button wire:click.prevent="deleteComment" id="deleteComment" onclick="return confirm('Are you sure you want to delete comment?') || event.stopImmediatePropagation()" class="mr-2 inline-flex items-center font-semibold text-xs text-red-700 uppercase tracking-widest hover:underline transition ease-in-out duration-150">Delete</button>
                @endif
            </div>

            @if ($replying)
                <livewire:comment-create :parent-comment="$comment" :post="$comment->post" />
            @endif

            @if ($comment->comments->count())
                <div class="mt-3">
                    @foreach ($comment->comments as $childComment)
                        <livewire:comment-item :comment="$childComment" wire:key="comment-{{ $childComment->id }}" />
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
