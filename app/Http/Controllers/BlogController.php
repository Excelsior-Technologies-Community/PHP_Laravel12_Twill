<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with('postCategories', 'postTags')
            ->where('published', true)
            ->orderBy('publish_date', 'desc')
            ->paginate(9);
        
        // Popular posts - will work after migration
        $popularPosts = collect();
        if (\Schema::hasColumn('posts', 'views')) {
            $popularPosts = Post::where('published', true)
                ->orderBy('views', 'desc')
                ->take(5)
                ->get();
        }
        
        return view('blog.index', compact('posts', 'popularPosts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        
        // Increment views if column exists
        if (\Schema::hasColumn('posts', 'views')) {
            $post->increment('views');
        }
        
        $relatedPosts = Post::where('published', true)
            ->where('id', '!=', $post->id)
            ->whereHas('postCategories', function($q) use ($post) {
                $q->whereIn('categories.id', $post->postCategories->pluck('id'));
            })
            ->take(3)
            ->get();
        
        return view('blog.show', compact('post', 'relatedPosts'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->where('published', true)->paginate(9);
        
        return view('blog.category', compact('category', 'posts'));
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->where('published', true)->paginate(9);
        
        return view('blog.tag', compact('tag', 'posts'));
    }
}