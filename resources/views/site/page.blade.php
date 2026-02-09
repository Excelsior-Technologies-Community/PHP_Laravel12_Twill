<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $item->title }}</title>
</head>
<body>

    <h1>{{ $item->title }}</h1>

    {{-- Render Twill blocks (REFERENCE STYLE) --}}
    @if ($item->blocks)
        @foreach ($item->blocks as $block)
            @include('blocks.' . $block->type)
        @endforeach
    @endif

</body>
</html>
