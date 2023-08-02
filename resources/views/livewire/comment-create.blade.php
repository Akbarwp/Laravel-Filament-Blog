<div>
    <form x-data="{
        focused: {{ $parentComment ? 'true' : 'false' }},
        isEdit: {{ $commentModel ? 'true' : 'false' }},
        init() {
            if (this.isEdit || this.focused) {
                this.$refs.input.focus();
            }

            $wire.on('commentCreated', () => {
                this.focused = false;
            })
        }
    }" 
    method="post" wire:submit.prevent='createComment'>
        @csrf
        <div class="relative mb-3">
            <textarea @click="focused = true" wire:model='comment' x-ref="input" class="block min-h-[auto] w-full rounded bg-white border-1 border-blue-500 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 focus:text-primary" id="comment" :rows="isEdit || focused ? '2' : '1'" placeholder="Leave a comment"></textarea>
        </div>
        <div :class="isEdit || focused ? '' : 'hidden'">
            <button type="submit" class="mr-2 inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none transition ease-in-out duration-150">Comment</button>
            <button @click="focused = false; isEdit = false; $wire.emitUp('cancelEditing')" type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none transition ease-in-out duration-150">Cancel</button>
        </div>
    </form>
</div>
