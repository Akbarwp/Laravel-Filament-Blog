<?php 
    /** @var $post Illuminate\Pagination\LengthAwarePagination */
?>

<x-app-layout meta-description="Laravel Blog with Filament">
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