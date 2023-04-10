<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class Post extends Model
{
    use HasFactory, HasSlug;

    protected $guarded = ["id"];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function shortBody($words = 33)
    {
        return Str::words(strip_tags($this->body), $words);
    }

    public function getFormatedDate()
    {
        return Carbon::make($this->published_at)->format('d F Y');
    }

    public function humanReadTime(): Attribute
    {
        return new Attribute(
            get: function($value, $attribute) {
                $words = Str::wordCount(strip_tags($attribute['body']));
                $minutes = ceil($words / 200);

                return $minutes . ' ' . str('mins')->plural($minutes) . ', ' . $words . ' ' . str('words')->plural($words);
            }
        );
    }
}
