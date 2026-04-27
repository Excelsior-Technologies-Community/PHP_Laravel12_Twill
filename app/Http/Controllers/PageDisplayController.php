<?php

namespace App\Http\Controllers;

use A17\Twill\Facades\TwillAppSettings;
use App\Repositories\PageRepository;
use Illuminate\Contracts\View\View;
use App\Models\Page;

class PageDisplayController extends Controller
{
    public function show(string $slug, PageRepository $pageRepository): View
    {
        $page = $pageRepository->forSlug($slug);

        if (!$page) {
            abort(404);
        }

        // Increment Page Views
        $page->increment('views');

        //  Get Related Pages
        $relatedPages = Page::where('id', '!=', $page->id)
            ->where('published', 1)
            ->latest()
            ->take(3)
            ->get();

        return view('site.page', [
            'item' => $page,
            'relatedPages' => $relatedPages
        ]);
    }

 public function home(): View
{
    $homepage = TwillAppSettings::get('homepage.homepage.page');

    if ($homepage && $homepage->isNotEmpty()) {
        $frontPage = $homepage->first();

        if ($frontPage && $frontPage->published) {
            return view('site.page', ['item' => $frontPage]);
        }
    }

    // fallback to latest page
    $page = Page::published()->latest()->first();

    if ($page) {
        return view('site.page', ['item' => $page]);
    }

    abort(404);
}
}