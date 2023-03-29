<x-app-layout :meta-title="'AkbarWP Laravel blog - About Me page'" :meta-description="'About Me'">
    <section class="w-full flex flex-col items-center px-3">
        <article class="w-full flex flex-col shadow my-4">
            <a class="hover:opacity-75">
                @if ($widget->image)
                    <img src="{{ $widget->image }}" class="w-full">
                @else
                    <img src="https://source.unsplash.com/1920x1080?user">
                @endif
            </a>
            <div class="bg-white flex flex-col justify-start p-6">
                <h1 class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $widget->title }}</h1>
                <div class="text-justify">
                    {!! $widget->content !!}
                </div>
            </div>
        </article>
    </section>
</x-app-layout>