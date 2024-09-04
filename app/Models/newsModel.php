<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class newsModel extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'feature',
        'excerpt',
        'content',
        'user_id',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'slug',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Generate a unique slug using the title.
     *
     * @return string
     */
    public function generateUniqueSlug()
    {
        // Generate the slug from the title
        $generatedSlug = Str::slug($this->title, '-');

        // Ensure uniqueness
        $originalSlug = $generatedSlug;
        $count = 1;

        while (self::where('slug', $generatedSlug)->exists()) {
            $generatedSlug = $originalSlug . '-' . $count++;
        }

        return $generatedSlug;
    }

    /**
     * Generate a unique slug from a given slug (from the request).
     *
     * @param string $slug
     * @return string
     */
    public function generateUniqueSlugFromRequest($slug)
    {
        // Generate the slug from the provided slug
        $generatedSlug = Str::slug($slug, '-');

        // Ensure uniqueness
        $originalSlug = $generatedSlug;
        $count = 1;

        while (self::where('slug', $generatedSlug)->exists()) {
            $generatedSlug = $originalSlug . '-' . $count++;
        }

        return $generatedSlug;
    }
}
