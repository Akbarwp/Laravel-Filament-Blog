<article class="flex mx-auto bg-white flex-col shadow my-4 max-w-sm lg:max-w-2xl">
    <!-- Article Image -->
    <a class="hover:opacity-75 transition-opacity">
        @if ($post->thumbnail)
            <img src="{{ $post->thumbnail }}" class="w-full h-96 rounded-t-md">
        @else
            <img src="https://source.unsplash.com/1920x1080?{{ $post->slug }}" class="rounded-t-md">
        @endif
    </a>
    <div class="bg-white flex flex-col justify-start p-6">
        <div class="flex">
            @foreach ($post->category as $category)
                <a href="{{ route('post.byCategory', $category) }}" class="text-blue-700 text-sm font-bold uppercase pb-4 mr-2">{{ $category->title }}</a>
            @endforeach
        </div>

        <a href="{{ route('post.show', $post) }}" class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $post->title }}</a>
        <p class="text-sm pb-3">
            By <a href="#" class="font-semibold hover:text-slate-800">{{ $post->user->name }}</a>, Published on <span class="font-semibold text-green-500">{{ $post->getFormatedDate() }} </span>| {{ $post->human_read_time }}
        </p>
        <a class="pb-6">{{ $post->shortBody() }}</a>
        <a href="{{ route('post.show', $post) }}" class="uppercase text-slate-800 hover:text-blue-700">Continue Reading <i class="fas fa-arrow-right"></i></a>
    </div>
</article>