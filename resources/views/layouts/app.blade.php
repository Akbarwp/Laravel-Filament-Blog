<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $metaTitle ?: 'Laravel Filament Blog' }}</title>

    <meta name="author" content="AkbarWP">
    <meta name="description" content="{{ $metaDescription }}">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }

        pre {
            padding: 1rem;
            background-color: #1a202c;
            color: white;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
        blockquote {
            display: block;
            margin-top: 1em;
            margin-bottom: 1em;
            margin-left: 40px;
            margin-right: 40px;
            font-style: italic;
        }
        h2 {
            display: block;
            font-size: 1.5em;
            margin-top: 0.83em;
            margin-bottom: 0.83em;
            margin-left: 0;
            margin-right: 0;
            font-weight: bold;
        }
        h3 {
            display: block;
            font-size: 1.17em;
            margin-top: 1em;
            margin-bottom: 1em;
            margin-left: 0;
            margin-right: 0;
            font-weight: bold;
        }
    </style>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-50 font-family-karla">

    <!-- Text Header -->
    <header class="w-full container mx-auto">
        <div class="flex flex-col items-center py-12">
            <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="{{ route('home') }}">
                Laravel Filament Blog
            </a>
            <p class="text-lg text-gray-600">
                {{ \App\Models\TextWidget::getTitle('header') }}
            </p>
        </div>
    </header>

    <!-- Topic Nav -->
    <nav class="w-full py-4 border-t border-b bg-gray-100" x-data="{ open: false }">
        <div class="block sm:hidden">
            <a href="#" class="block md:hidden text-base font-bold uppercase text-center flex justify-center items-center" @click="open=!open">
                Topics <i :class="open ? 'fa-chevron-down': 'fa-chevron-up'" class="fas ml-2"></i>
            </a>
        </div>
        <div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
            <div class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-center text-sm font-bold uppercase mt-0 px-6 py-2">
                <a href="{{ route('home') }}" class="hover:bg-blue-100 rounded py-2 px-4 mx-2 transition-colors">Home</a>
                @foreach ($categories as $category)
                    <a href="{{ route('post.byCategory', $category) }}" class="hover:bg-blue-100 rounded py-2 px-4 mx-2 transition-colors">{{ $category->title }}</a>
                @endforeach
                <a href="{{ route('about-me') }}" class="hover:bg-blue-100 rounded py-2 px-4 mx-2 transition-colors">About Me</a>
            </div>
        </div>
    </nav>


    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Section -->
        {{ $slot }}

    </div>

    <footer class="w-full border-t bg-white pb-12">
        <div class="w-full container mx-auto flex flex-col items-center">
            <div class="pb-6">&copy; Created by <a href="https://github.com/Akbarwp" target="_blank" class="text-blue-600">AkbarWP</a> with <span class="text-red-500">❤</span></div>
        </div>
    </footer>

</body>
</html>