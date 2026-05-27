<?php

namespace App\Models;

use A17\Twill\Models\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'description',
        'published',
        'publish_date',
        'author',
        'views'
    ];

    // Categories relationship - name changed
    public function postCategories()
    {
        return $this->belongsToMany(Category::class);
    }

    // Tags relationship - name changed to avoid conflict with Twill
    public function postTags()
    {
        return $this->belongsToMany(Tag::class);
    }
}