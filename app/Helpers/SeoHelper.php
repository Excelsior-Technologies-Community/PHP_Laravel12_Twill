<?php

namespace App\Helpers;

class SeoHelper
{
    public static function generateMeta($title, $description = null, $image = null)
    {
        $meta = [
            'title' => $title . ' - ' . config('app.name'),
            'description' => $description ?? config('app.description', ''),
            'og_title' => $title,
            'og_description' => $description,
            'og_image' => $image ?? config('app.og_image'),
            'og_url' => url()->current(),
            'twitter_card' => 'summary_large_image'
        ];
        
        return $meta;
    }
}