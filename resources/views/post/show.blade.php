<x-app-layout :meta-title="$post->meta_title ?: $post->title" :meta-description="$post->meta_description">
    <!-- Post Section -->
    <section class="w-full md:w-2/3 flex flex-col px-3">
        <article class="flex flex-col shadow my-4">
            <!-- Article Image -->
            <a class="hover:opacity-75">
                @if ($post->thumbnail)
                    <img src="{{ $post->thumbnail }}" class="w-full">
                @else
                    <img src="https://source.unsplash.com/1920x1080?{{ $post->slug }}">
                @endif
            </a>
            <div class="bg-white flex flex-col justify-start p-6">
                <div class="flex">
                    @foreach ($post->category as $category)
                        <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4 mr-2">{{ $category->title }}</a>
                    @endforeach
                </div>
                <h1 class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $post->title }}</h1>
                <p class="text-sm pb-8">
                    By <a href="#" class="font-semibold hover:text-gray-800">{{ $post->user->name }}</a>, Published on <span class="font-semibold text-green-500">{{ $post->getFormatedDate() }}</span> | {{ $post->human_read_time }}
                </p>
                <h1 class="text-2xl font-bold pb-3">Introduction</h1>
                <div class="text-justify">
                    {!! $post->body !!}
                </div>

                <livewire:up-down-vote :post="$post">
            </div>
        </article>

        {{-- Awal Pagination --}}
        <div class="w-full flex pt-6">
            <div class="w-1/2">
                @if ($previous)
                    <a href="{{ route('post.show', $previous) }}" class="block w-full bg-white shadow hover:shadow-md text-left p-6">
                        <p class="text-lg text-blue-800 font-bold flex items-center"><i class="fas fa-arrow-left pr-1"></i> Previous</p>
                        <p class="pt-2">{{ Str::words($previous->title, 5) }}</p>
                    </a>
                @endif
            </div>
            <div class="w-1/2">
                @if ($next)
                    <a href="{{ route('post.show', $next) }}" class="block w-full bg-white shadow hover:shadow-md text-right p-6">
                        <p class="text-lg text-blue-800 font-bold flex items-center justify-end">Next <i class="fas fa-arrow-right pl-1"></i></p>
                        <p class="pt-2">{{ Str::words($next->title, 5) }}</p>
                    </a>
                @endif
            </div>
        </div>
        {{-- Akhir Pagination --}}

        <livewire:comments :post="$post" />
    </section>

    <!-- Sidebar Section -->
    <x-sidebar></x-sidebar>
</x-app-layout>