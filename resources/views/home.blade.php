<?php 
    /** @var $post Illuminate\Pagination\LengthAwarePagination */
?>

<x-app-layout meta-description="Laravel Blog with Filament">
    {{-- <div class="container mx-auto flex flex-wrap py-6">
        <!-- Posts Section -->
        <section class="w-full md:w-2/3 flex flex-col items-center px-3">

            @foreach ($posts as $post)
                <x-post-item :post="$post"></x-post-item>
            @endforeach
            
            <!-- Pagination -->
            <div class="flex items-center py-8">
                {{ $posts->onEachSide(1)->links() }}
            </div>
        
        </section>

        <!-- Sidebar Section -->
        <x-sidebar></x-sidebar>
    </div> --}}

    <div class="container mx-auto py-6 pl-1">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            {{-- Latest Post --}}
            <div class="col-span-2">
                <h2 class="text-lg sm:text-xl font-bold text-blue-500 uppercase pb-1 border-b-2 border-blue-500 mb-3">
                    Latest Post
                </h2>

                @if ($latestPost)
                    <x-post-item :post="$latestPost"></x-post-item>
                @endif
            </div>

            {{-- Popular Post --}}
            <div>
                <h2 class="text-lg sm:text-xl font-bold text-blue-500 uppercase pb-1 border-b-2 border-blue-500 mb-3">
                    Popular Post
                </h2>

                @foreach ($popularPost as $post)
                    <div class="grid grid-cols-4 gap-2 mb-4">
                        <div class="pt-1 hover:opacity-75 transition-opacity">
                            @if ($post->thumbnail)
                                <img src="{{ $post->thumbnail }}" class="w-full rounded-md">
                            @else
                                <img src="https://source.unsplash.com/1920x1080?{{ $post->slug }}" class="w-full rounded-md">
                            @endif
                        </div>

                        <div class="col-span-3">
                            <a href="{{ route('post.show', $post) }}">
                                <h3 class="text-sm font-bold uppercase whitespace-nowrap truncate">{{ $post->title }}</h3>
                            </a>
                            <div class="flex gap-4 mb-2">
                                @foreach($post->category as $category)
                                    <a href="{{ route('post.byCategory', $category) }}" class="bg-blue-500 text-white p-1 rounded text-xs font-bold uppercase">
                                        {{$category->title}}
                                    </a>
                                @endforeach
                            </div>
                            <div class="text-xs">
                                {{ $post->shortBody(10) }}
                            </div>
                            <a href="{{ route('post.show', $post) }}" class="text-xs uppercase text-slate-800 hover:text-blue-700">
                                Continue Reading <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

            {{-- Recomended Post --}}
            <div>
                <h2 class="text-lg sm:text-xl font-bold text-blue-500 uppercase pb-1 border-b-2 border-blue-500 mb-3">
                    Recommended Posts
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    @foreach($recommendedPost as $post)
                        <x-post-item :post="$post"></x-post-item>
                    @endforeach
                </div>
            </div>

            {{-- Latest Category --}}
            <div>
                @foreach ($categories as $category)
                    <div>
                        <h2 class="text-lg sm:text-xl font-bold text-blue-500 uppercase pb-1 border-b-2 border-blue-500 mb-3">
                            Category "{{$category->title}}"
                            <a href="{{route('post.byCategory', $category)}}">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </h2>

                        <div class="mb-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                @foreach($category->publishedPosts()->limit(3)->get() as $post)
                                    <x-post-item :post="$post"></x-post-item>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
</x-app-layout>