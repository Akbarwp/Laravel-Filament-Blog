<x-app-layout>
    <!-- Posts Section -->
    <section class="w-full md:w-2/3 flex flex-col px-3">

        @foreach ($posts as $post)
            <div>
                <a href="{{ route('post.show', $post) }}" class="text-lg sm:text-xl font-bold text-blue-700 hover:text-blue-500 mb-2">
                    {!! str_replace(request()->get('q'), '<span class="bg-yellow-300">' . request()->get('q') . '</span>', $post->title) !!}
                </a>
                <p>
                    {!! str_replace(request()->get('q'), '<span class="bg-yellow-300">' . request()->get('q') . '</span>', $post->shortBody()) !!}
                </p>
                <hr class="my-4">
            </div>
        @endforeach
        
        <!-- Pagination -->
        <div class="flex items-center py-8">
            {{ $posts->onEachSide(1)->links() }}
        </div>
    
    </section>

    <!-- Sidebar Section -->
    <x-sidebar></x-sidebar>
</x-app-layout>