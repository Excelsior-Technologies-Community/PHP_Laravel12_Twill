<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $item->title }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 900px;
            margin: 40px auto;
        }

        .card {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        h1 {
            margin-bottom: 10px;
        }

        .views {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .related {
            margin-top: 30px;
        }

        .related-grid {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .related-card {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            width: 30%;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .related-card:hover {
            transform: translateY(-5px);
        }

        .related-card a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        hr {
            margin: 30px 0;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- Main Page Card -->
    <div class="card">
        <h1>{{ $item->title }}</h1>

        <!-- Views -->
        <p class="views">👁 Total Views: {{ $item->views ?? 0 }}</p>

        <!-- Twill Blocks -->
        @if ($item->blocks)
            @foreach ($item->blocks as $block)
                @include('blocks.' . $block->type)
            @endforeach
        @endif
    </div>

    <!-- Related Pages -->
    @isset($relatedPages)
        <div class="card related">
            <h3>🔥 Related Pages</h3>

            <div class="related-grid">
                @foreach($relatedPages as $rel)
                    <div class="related-card">
                        <a href="{{ url($rel->slug) }}">
                            {{ $rel->title }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endisset

</div>

</body>
</html>