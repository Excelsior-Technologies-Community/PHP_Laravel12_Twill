<!DOCTYPE html>
<html>
<head>
    <title>Blog - {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .blog-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem; }
        .blog-card { border: 1px solid #ddd; border-radius: 8px; overflow: hidden; transition: transform 0.3s; }
        .blog-card:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .blog-image { width: 100%; height: 200px; object-fit: cover; }
        .blog-content { padding: 1.5rem; }
        .blog-title { margin: 0 0 0.5rem; font-size: 1.25rem; }
        .blog-meta { color: #666; font-size: 0.875rem; margin-bottom: 1rem; }
        .read-more { display: inline-block; margin-top: 1rem; color: #007bff; text-decoration: none; }
        .sidebar { background: #f8f9fa; padding: 1.5rem; border-radius: 8px; }
        .container { max-width: 1200px; margin: 0 auto; padding: 2rem; display: grid; grid-template-columns: 3fr 1fr; gap: 2rem; }
    </style>
</head>
<body>
    <div class="container">
        <main>
            <h1>Blog</h1>
            <div class="blog-grid">
                @foreach($posts as $post)
                    <article class="blog-card">
                        @if($post->images('cover')->first())
                            <img class="blog-image" src="{{ $post->images('cover')->first()->url() }}" alt="{{ $post->title }}">
                        @endif
                        <div class="blog-content">
                            <h2 class="blog-title">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h2>
                            <div class="blog-meta">
                                {{ $post->publish_date->format('F j, Y') }} | 
                                Views: {{ $post->views ?? 0 }}
                            </div>
                            <p>{{ Str::limit($post->description, 150) }}</p>
                            
                            @if($post->categories->count())
                                <div>Categories: 
                                    @foreach($post->categories as $cat)
                                        <a href="{{ route('blog.category', $cat->slug) }}">{{ $cat->name }}</a>@if(!$loop->last), @endif
                                    @endforeach
                                </div>
                            @endif
                            
                            <a href="{{ route('blog.show', $post->slug) }}" class="read-more">Read More →</a>
                        </div>
                    </article>
                @endforeach
            </div>
            {{ $posts->links() }}
        </main>
        
        <aside class="sidebar">
            <h3>Popular Posts</h3>
            @foreach($popularPosts ?? [] as $popular)
                <div style="margin-bottom: 1rem;">
                    <a href="{{ route('blog.show', $popular->slug) }}">{{ $popular->title }}</a>
                    <div style="font-size: 0.875rem; color: #666;">{{ $popular->views ?? 0 }} views</div>
                </div>
            @endforeach
        </aside>
    </div>
</body>
</html>