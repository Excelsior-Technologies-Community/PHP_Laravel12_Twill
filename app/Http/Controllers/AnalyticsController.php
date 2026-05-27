<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function dashboard()
    {
        $totalPages = Page::count();
        $publishedPages = Page::where('published', true)->count();
        $totalViews = Page::sum('views') + (Post::sum('views') ?? 0);
        
        $popularPages = Page::orderBy('views', 'desc')->take(10)->get();
        $recentActivity = Page::where('updated_at', '>=', Carbon::now()->subDays(7))->get();
        
        return view('admin.analytics', compact('totalPages', 'publishedPages', 'totalViews', 'popularPages', 'recentActivity'));
    }
}