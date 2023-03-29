<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin123')
        ]);

        Category::factory()->create([
            'title' => 'Java',
        ]);
        Category::factory()->create([
            'title' => 'PHP',
        ]);
        Category::factory()->create([
            'title' => 'Laravel',
        ]);

        Post::factory(30)->create();
    }
}
