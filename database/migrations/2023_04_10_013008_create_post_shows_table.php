<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_shows', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');
            $table->string('user_agent');
            $table->foreignId('post_id')->constrained('posts', 'id');
            $table->foreignId('user_id')->nullable()->constrained('users', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_shows');
    }
};
