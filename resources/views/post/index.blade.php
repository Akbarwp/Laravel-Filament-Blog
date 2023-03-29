<?php 
    /** @var $post Illuminate\Pagination\LengthAwarePagination */
?>

<x-app-layout :meta-title=" 'Laravel Filament Blog - Posts by category ' . $category->title" meta-description="Laravel Blog by Category">
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
</x-app-layout>