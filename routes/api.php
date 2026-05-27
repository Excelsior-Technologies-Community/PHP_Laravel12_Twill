<?php

use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;

Route::get('/pages', function () {
    return Page::where('published', true)->get(['id', 'title', 'slug', 'description']);
});

Route::get('/pages/{slug}', function ($slug) {
    $page = Page::where('slug', $slug)->firstOrFail();
    return response()->json($page);
});

Route::get('/posts', function (Request $request) {
    $query = Post::where('published', true);
    
    if ($request->has('category')) {
        $query->whereHas('categories', function($q) use ($request) {
            $q->where('slug', $request->category);
        });
    }
    
    return $query->paginate(15);
});

Route::get('/search', function (Request $request) {
    $query = $request->get('q');
    
    $pages = Page::where('title', 'like', "%{$query}%")
        ->orWhere('description', 'like', "%{$query}%")
        ->get();
        
    return response()->json($pages);
});