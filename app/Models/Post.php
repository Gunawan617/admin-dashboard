<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'published_at',
        'status',
        'author',
        'category',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
