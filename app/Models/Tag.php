<?php

namespace App\Models;

use A17\Twill\Models\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'slug'];
    
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}